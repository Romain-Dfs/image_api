<?php

namespace FileManager\Presentation\Image\ViewModel;

class GetImageJsonViewModel
{
    public int $id;
    public string $cloudinaryId;
    public string $format;
    public string $url;

    public array $errors;
}