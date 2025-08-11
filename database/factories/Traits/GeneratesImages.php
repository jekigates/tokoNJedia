<?php

namespace Database\Factories\Traits;

trait GeneratesImages
{
    protected function generatePlaceholderImage(string $directory, int $width = 300, int $height = 300): string
    {
        $uniqueId = uniqid();

        $optimizedWidth = min($width, 700);
        $optimizedHeight = min($height, 700);

        return "https://picsum.photos/{$optimizedWidth}/{$optimizedHeight}?random={$uniqueId}";
    }

    private function getCategoryFromDirectory(string $directory): string
    {
        $categoryMap = [
            'user-images' => 'portrait,people',
            'product-images' => 'product,technology,gadget,electronics',
            'merchant/images' => 'business,shop,store',
            'merchant/banner-images' => 'business,office,modern,architecture',
        ];

        foreach ($categoryMap as $dir => $category) {
            if (str_contains($directory, $dir)) {
                return $category;
            }
        }

        return 'business';
    }
}
