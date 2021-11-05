<?php

namespace Festival\Domain\User\UseCase\Login;

interface LoginInterface
{
   public function execute(LoginRequest $request, LoginPresenter $presenter): void;
}
