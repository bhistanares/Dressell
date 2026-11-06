<?php

namespace App\Http\Controllers;

/**
 * Controller alias untuk kompatibilitas ke belakang.
 * Seluruh fungsionalitas kini berada pada AuthController.
 */
class AdminAuthController extends AuthController
{
    // Mewarisi showLogin(), login(), dan logout() dari AuthController
}
