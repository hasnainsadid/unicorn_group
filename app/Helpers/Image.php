<?php

function imageOptimizeTo(string $src, string $dest, string $ext, int $maxSide = 2000, int $quality = 85): bool
{
    $ext = strtolower($ext);
    if ($ext === 'jpeg') {
        $ext = 'jpg';
    }
    if (!in_array($ext, ['jpg', 'png', 'webp'], true) || !function_exists('imagecreatetruecolor')) {
        return false;
    }

    $info = @getimagesize($src);
    if (!$info) {
        return false;
    }
    [$w, $h, $type] = $info;
    $origSize = filesize($src);

    // Already small: touch korbo na, quality 100% same thakbe
    if ($w <= $maxSide && $h <= $maxSide && $origSize <= 600 * 1024) {
        return false;
    }

    @ini_set('memory_limit', '512M');

    $img = match ($type) {
        IMAGETYPE_JPEG => @imagecreatefromjpeg($src),
        IMAGETYPE_PNG  => @imagecreatefrompng($src),
        IMAGETYPE_WEBP => @imagecreatefromwebp($src),
        default        => false,
    };
    if (!$img) {
        return false;
    }

    // Phone photo er ghurano (EXIF orientation) thik rakhi
    if ($type === IMAGETYPE_JPEG && function_exists('exif_read_data')) {
        $orientation = (int) (@exif_read_data($src)['Orientation'] ?? 1);
        $angle = [3 => 180, 6 => -90, 8 => 90][$orientation] ?? 0;
        if ($angle) {
            $rotated = imagerotate($img, $angle, 0);
            if ($rotated) {
                $img = $rotated;
            }
        }
    }

    if ($type !== IMAGETYPE_JPEG) {          // transparency (logo) thik rakhi
        imagealphablending($img, false);
        imagesavealpha($img, true);
    }

    $w = imagesx($img);
    $h = imagesy($img);
    $resized = false;
    if (max($w, $h) > $maxSide) {
        $scale = $maxSide / max($w, $h);
        $scaled = imagescale($img, (int) round($w * $scale), (int) round($h * $scale), IMG_BICUBIC);
        if ($scaled) {
            $img = $scaled;
            $resized = true;
            if ($type !== IMAGETYPE_JPEG) {
                imagealphablending($img, false);
                imagesavealpha($img, true);
            }
        }
    }

    $full = public_path($dest);
    $ok = match ($ext) {
        'jpg'  => (function () use ($img, $full, $quality) { imageinterlace($img, true); return imagejpeg($img, $full, $quality); })(),
        'png'  => imagepng($img, $full, 9),
        'webp' => imagewebp($img, $full, $quality),
    };
    imagedestroy($img);

    if (!$ok) {
        return false;
    }

    // Resize hoyni ar notun file boro hoye gele, original-i bhalo
    if (!$resized && filesize($full) >= $origSize) {
        @unlink($full);
        return false;
    }

    return true;
}

function imageUploadManager($image, $slug, $path)
{
    $dir = 'uploads/' . trim($path, '/') . '/';
    $extension = $image->getClientOriginalExtension();
    $image_name = $dir . $slug . '_' . time() . '_' . uniqid() . '.' . $extension;

    if (!file_exists(public_path($dir))) {
        mkdir(public_path($dir), 0777, true);
    }

    if (!imageOptimizeTo($image->getRealPath(), $image_name, $extension)) {
        $image->move(public_path($dir), basename($image_name));
    }

    return $image_name;
}

function imageUpdateManager($image, $slug, $path, $old_image)
{
    $image_name = imageUploadManager($image, $slug, $path);

    if ($old_image && $old_image != 'default.png' && file_exists(public_path($old_image))) {
        @unlink(public_path($old_image));
    }

    return $image_name;
}

function imageDeleteManager($old_image)
{
    if ($old_image && $old_image != 'default.png' && file_exists(public_path($old_image))) {
        @unlink(public_path($old_image));
    }
}

function imageShow($image)
{
    if ($image) {
        if (file_exists(public_path($image))) {
            return asset($image);
        } else {
            return asset('uploads/default.png');
        }
    } else {
        return asset('uploads/default.png');
    }
}

function thumbnail($product)
{
    $thumbnail = $product->images->where('is_thumbnail', 1)->first();
    if ($thumbnail) {
        return $thumbnail->image;
    } else {
        return 'uploads/default.png';
    }
}
