<?php

namespace FileManager\Domain\Image\UseCase\DeleteImage;

interface DeleteImageInterface
{
    public function execute(DeleteImageRequest $request, DeleteImagePresenterInterface $presenter): void;
}