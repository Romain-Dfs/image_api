<?php

namespace Festival\Domain\User\UseCase\Login;

interface LoginPresenter
{
   public function present(LoginResponse $response): void;
}
