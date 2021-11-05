<?php

namespace Festival\Domain\User\UseCase\Register;

interface RegisterInterface
{
   public function execute(RegisterRequest $request, RegisterPresenter $presenter): void;
}
