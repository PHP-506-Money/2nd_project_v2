<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\UserTokenRepositoryInterface;
use App\Http\Requests\SendEmailRequest;
use App\Mail\UserResetPasswordMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Exception;

class PasswordController extends Controller
{
    private $userRepository;
    private $userTokenRepository;

    private const MAIL_SENDED_SESSION_KEY = 'user_reset_password_mail_sended_action';

    public function __construct(
        UserRepositoryInterface $userRepository,
        UserTokenRepositoryInterface $userTokenRepository,
    )
    {
        $this->userRepository = $userRepository;
        $this->userTokenRepository = $userTokenRepository;
    }
    
    /**
    * 패스워드 재설정 메일 전송 폼 페이지
    *
    * @return \Illuminate\Contracts\View\View
    */
    public function emailFormResetPassword()
    {
        return view('user.reset_password.email_form');
    }

    /**
    * 유저 패스워드 재설정 메일 전송
    *
    * @param SendEmailRequest $request
    * @return \Illuminate\Http\RedirectResponse
    */
    public function sendEmailResetPassword(SendEmailRequest $request)
    {   
        try {
            $user = $this->userRepository->findFromEmail($request->email);
            $userToken = $this->userTokenRepository->updateOrCreateUserToken($user->id);
            Log::info(__METHOD__ . '...ID:' . $user->id . ' 유저에게 패스워드 재설정용 메일을 전송합니다.');
            Mail::send(new UserResetPasswordMail($user, $userToken));
            Log::info(__METHOD__ . '...ID:' . $user->id . ' 유저에게 패스워드 재설정용 메일을 전송했습니다.');
        } catch(Exception $e) {
            Log::error(__METHOD__ . '...유저에게 패스워드 재설정용 메일 전송에 실패했습니다. request_email = ' . $request->email . ' error_message = ' . $e);
            return redirect()->route('user.password_reset.email_form')
                ->with('flash_message', '처리에 실패했습니다. 잠시 후 다시 시도해주세요.');
        }
        // 메일 전송완료 화면 부정 액세스를 막기 위한 세션 키
        session()->put(self::MAIL_SENDED_SESSION_KEY, 'user_reset_password_send_email');

        return redirect()->route('password_reset.email.send_complete');
    }
}
