<?php
/**
 * Created by PhpStorm.
 * User: Anh Lai
 * Date: 2017/5/11 0011
 * Time: 下午 12:11
 */

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\User;
use AuthUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountPageController extends Controller
{


    public function __construct()
    {
        $this->middleware('base.check');
    }

    function get(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();
        if (!$user->getIsLogin()) {
            $encodeUrl = urlencode(base64_encode("account"));
            $encodeName = urlencode(base64_encode("账号管理"));
            return redirect("login?from=$encodeUrl&fromName=$encodeName");
        }
        $authUtils = new AuthUtils();
        $authUtils->getAllAuth($user);
        return view('account.account.index')->with('_USER', $user)->with("topNavValueText", "账号管理")->with("authUtils", $authUtils);
    }
}