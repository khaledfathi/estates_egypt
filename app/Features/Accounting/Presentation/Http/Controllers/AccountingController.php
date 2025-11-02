<?php
declare (strict_types=1);

namespace App\Features\Accounting\Presentation\Http\Controllers; 

use App\Http\Controllers\Controller;

class AccountingController extends Controller {
    public function index(){
        return view('accounting::index');
    }
}