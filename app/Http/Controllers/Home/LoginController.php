<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * 登录页面
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        echo '前台登录页';die;
        return view('home.login',['title'=>'登录']);

    }

    /**
     * 处理登录的信息
     *
     * @return \Illuminate\Http\Response
     */
    public function dologin(Request $request)
    {
        $um = $request->username;

        $rs = DB::table('user')->where('username',$um)->first();

        if(!$rs){

            return back()->with('error','账号或密码错误');
        }

        $pass = $rs->password;

        // if(!Hash::check($request->password,$pass)){

        //     return back()->with('error','账号或密码错误');
        // }

        // $code = session('code');
        
        // if($code != $request->code){

        //     return back()->with('error','验证码错误');
        // }

        session(['uid'=>$rs->id]);

        return redirect('/home/admins')->with('success','登录成功');
    }

    /**
     * 验证码
     *
     * @return \Illuminate\Http\Response
     */
    public function captcha()
    {
        $phrase = new PhraseBuilder;
        //设置验证码位数
        $code = $phrase->build(4);
        //生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder($code, $phrase);
        //设置背景颜色
        $builder->setBackgroundColor(123, 203, 230);
        $builder->setMaxAngle(25);
        $builder->setMaxBehindLines(0);
        $builder->setMaxFrontLines(0);
        //可以设置图片宽高及字体
        $builder->build($width = 100, $height = 35, $font = null);
        // 获取验证码的内容
        $phrase = $builder->getPhrase();
        //把内容存入session
        session(['code'=> $phrase]);
        //生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header("Content-Type:image/jpeg");
        $builder->output();
    }

    /**
     * 显示修改头像
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $rs = DB::table('user')->where('id',session('uid'))->first();

        return view('admin.profile',[
            'title'=>'修改头像',
            'rs'=>$rs
        ]);
    }

    /**
     * 处理头像
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $file = $request->file('file_upload');

        //名字
        $name = 'img_'.rand(1111,9999).time();

        //获取后缀
        $suffix = $file->getClientOriginalExtension();

        $file->move('./uploads',$name.'.'.$suffix);

        echo '/uploads/'.$name.'.'.$suffix;

        //修改数据表里面的信息
        $rs['profile'] = '/uploads/'.$name.'.'.$suffix;

        DB::table('user')->where('id',session('uid'))->update($rs);





    }

    /**
     * 修改密码页面
     *
     * @return \Illuminate\Http\Response
     */
    public function pass()
    {
        return view('admin.pass',['title'=>'修改密码']);
    }

    /**
     * 处理修改密码
     *
     * @return \Illuminate\Http\Response
     */
    public function dopass(Request $request)
    {
        $pass = $request->oldpass;

        $rs = DB::table('user')->where('id',session('uid'))->first();

        if(!Hash::check($pass,$rs->password )){

            return back()->with('error','旧密码有误');
        }
        
        //两次密码一致
        $res['password'] = Hash::make($request->password);

        $data = DB::table('user')->where('id',session('uid'))->update($res);

        if($data){

            session(['uid'=>'']);

            return redirect('/home/logins');
        } else {

            return back();
        }

    }


    /**
     * 退出
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        //清除session
        session(['uid'=>'']);

        //重定向
        return redirect('/home/logins')->with('success','退出成功');
    }
}
