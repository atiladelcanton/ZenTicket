<?php


namespace App\ZenTicket\Services;


use App\Mail\RegisterUser;
use App\ZenTicket\Contracts\ServiceContract;
use App\ZenTicket\Models\ProjectUser;
use App\ZenTicket\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

/**
 * Class UserService
 * @package App\ZenTicket\Services
 * @version 1.0.0
 */
class UserService implements ServiceContract
{

    private $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * @param string $column
     * @param string $orderColum
     * @return mixed
     */
    public function renderList(string $column = 'id', $orderColum = 'DESC')
    {
        return $this->user->getAll();
    }

    /**
     * @param $id
     * @return mixed
     * @throws Exception
     */
    public function renderEdit($id)
    {
        $user = $this->user->getById($id);

        if (is_null($user)) {
            throw new Exception(env('not_found'), 404);
        }
        return $user;
    }

    /**
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function buildUpdate(int $id, array $data)
    {
        if (isset($data['password'])) {
            if (!is_null($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }
        }


        $user =  $this->user->update($id, $data);
        if (isset($data['projects'])) {
            ProjectUser::where('user_id', $id)->delete();
            foreach ($data['projects'] as $project) {
                ProjectUser::create(
                    [
                        'user_id' => $id,
                        'project_id' => $project
                    ]
                );
            }
        }
    }

    /**
     * @param array $data
     * @return array
     */
    private function mapUserPassword(array $data)
    {
        return $data['password'] = $this->password_generate(8);
    }

    function password_generate($chars)
    {
        $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz)($';
        return substr(str_shuffle($data), 0, $chars);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function buildInsert(array $data)
    {
        $no_crypt = $this->mapUserPassword($data);
        $data['password'] = Hash::make($no_crypt);
        $data['password_no_crype'] = $no_crypt;
        $user = $this->user->create($data);
        DB::table('role_user')->insert(['user_id' => $user->id, 'role_id' => $data['role_id']]);
        Log::notice(['email' => $data['email'], 'senha' => $no_crypt]);
        foreach ($data['projects'] as $project) {
            ProjectUser::create(
                [
                    'user_id' => $user->id,
                    'project_id' => $project
                ]
            );
        }
        Mail::to($user->email)->send(new RegisterUser($user, $no_crypt));
    }

    /**
     * @param $id
     * @return mixed
     */
    public function buildDelete($id)
    {
        return $this->user->delete($id);
    }
}
