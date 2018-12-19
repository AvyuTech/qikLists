<?php
namespace app\models;

use app\components\SendMail;
use Yii;
use app\models\User;
use yii\base\Model;
use app\modules\student\models\StuMaster;
use app\modules\employee\models\EmpMaster;
/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $username;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'exist',
                'targetClass' => '\app\models\User',
                'targetAttribute' => 'u_email',
                //'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => Yii::t('app', 'There is no user with such Email.')
            ],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
		return [
			'username' => Yii::t('app', 'Email'),
		];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'u_email' => $this->username,
        ]);

        if ($user) {
            if (!User::isPasswordResetTokenValid($user->password_reset_token)) {
                $user->generatePasswordResetToken();
            }

            if ($user->save(false)) {
            	$userName = $user->u_name;
                $userEmail = $user->u_email;
            	 
            	if(!empty($userName) && !empty($userEmail)) {
                    $subject = "[Price Genius]: Your Reset Password Request";
                    $resetLink = Yii::$app->urlManager->createAbsoluteUrl(['api/reset-password', 'token' => $user->password_reset_token]);
                    $content = ['userName' => $userName, 'resetLink' => $resetLink];
                    $promotionName = "Forgot Password";
                    return SendMail::sendSupportMail($user->u_email, $user->u_name, $subject, $content, $promotionName);
          		}
            }
            
        }
        return false;
    }
}
