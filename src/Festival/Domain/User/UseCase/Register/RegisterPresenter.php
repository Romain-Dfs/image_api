<?php

namespace Festival\Domain\User\UseCase\Register;

interface RegisterPresenter
{
   public function present(RegisterResponse $response): void;
}
