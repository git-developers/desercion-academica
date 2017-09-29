<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;

use Symfony\Bundle\FrameworkBundle\Console\Application;

class TestController extends Controller {

    public function indexAction()
    {

        ini_set('display_startup_errors', 1);
        ini_set('display_errors', 1);
        error_reporting(-1);

//        echo `whoami`;
        echo 3333333333333333;

        exit;
    }

    public function cacheClearAction()
    {

        ini_set('display_startup_errors', 1);
        ini_set('display_errors', 1);
        error_reporting(-1);

        $application = new Application($this->get('kernel'));
        $application->setAutoExit(false);

        $input = new ArrayInput(array(
            'command' => 'cache:clear',
        ));

        // You can use NullOutput() if you don't need the output
        $output = new BufferedOutput();
        $application->run($input, $output);

        // return the output, don't use if you used NullOutput()
        $content = $output->fetch();

        return $this->json([
            'content' => $content,
        ]);
    }

    public function assetsInstallAction()
    {

        ini_set('display_startup_errors', 1);
        ini_set('display_errors', 1);
        error_reporting(-1);

        $application = new Application($this->get('kernel'));
        $application->setAutoExit(false);

//        $input = new ArrayInput(array(
//            'command' => 'assets:install',
//            '--symlink' => true,
//        ));

        $input = new ArrayInput(array(
            'assets:install',
            '--symlink',
            '~/public_html/rrda/web',
        ));

        // You can use NullOutput() if you don't need the output
        $output = new BufferedOutput();
        $application->run($input, $output);

        // return the output, don't use if you used NullOutput()
        $content = $output->fetch();

        return $this->json([
            'content' => $content,
        ]);
    }

    public function assetsDumpAction()
    {

        ini_set('display_startup_errors', 1);
        ini_set('display_errors', 1);
        error_reporting(-1);

        $application = new Application($this->get('kernel'));
        $application->setAutoExit(false);

        $input = new ArrayInput(array(
            'command' => 'assetic:dump',
        ));

        // You can use NullOutput() if you don't need the output
        $output = new BufferedOutput();
        $application->run($input, $output);

        // return the output, don't use if you used NullOutput()
        $content = $output->fetch();

        return $this->json([
            'content' => $content,
        ]);
    }


}
