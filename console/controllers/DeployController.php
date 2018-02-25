<?php

namespace console\controllers;

use backend\models\Server;
use Yii;
use yii\console\Controller;

/**
 * Class DeployController
 * @package console\controllers
 */
class DeployController extends Controller
{
    protected $sudoUser = null;

    public function init()
    {
        $this->sudoUser = yii::$app->params['deploymentSudoUser'];

        return parent::init();
    }

    /**
     * Update dependencies
     * @return bool
     */
    public function actionDependency()
    {
        $command = "composer update --no-dev";

        echo $command . PHP_EOL;

        system($command, $exitCode);

        return $exitCode === 0;
    }

    /**
     * Copy files
     * @return bool
     */
    public function actionCopy()
    {
        $commandArgs = [
            "-av",
            "--owner",
            "--group",
            "--ignore-times",
            "--checksum",
            "--links",
            "--perms",
            "--recursive",
            "--delete",
            "--size-only",
            "--force",
            "--numeric-ids",
            "--stats",
            "--exclude .git",
            "--exclude .htpasswd",
            "--exclude frontend/runtime",
            "--exclude backend/runtime",
            "--exclude frontend/web/assets",
            "--exclude backend/web/assets",
            "--exclude frontend/web/uploads",
            "--exclude backend/web/uploads",
        ];

        $commandMask = "rsync " . implode(" ", $commandArgs) . " %s %s/";

        $command = sprintf(
            $commandMask,
            __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "..",
            Yii::$app->params['deploymentPath']
        );

        if (!empty($this->sudoUser)) {
            $command = "sudo -u " . $this->sudoUser . " " . $command;
        }

        echo $command . PHP_EOL;

        system($command, $exitCode);

        return $exitCode === 0;
    }

    /**
     * Apply migrations
     * @return bool
     */
    public function actionMigrate()
    {
        $commandMask = "php %s/yii migrate/up --interactive=0";
        $command = sprintf($commandMask, Yii::$app->params['deploymentPath']);

        if (!empty($this->sudoUser)) {
            $command = "sudo -u " . $this->sudoUser . " " . $command;
        }

        echo $command . PHP_EOL;

        system($command, $exitCode);

        return $exitCode === 0;
    }

    /**
     * Reset temporary files
     * @return bool
     */
    public function actionReset()
    {
        $commandMask = "rm -rf %s/frontend/web/assets/*";
        $command = sprintf($commandMask, Yii::$app->params['deploymentPath']);

        if (!empty($this->sudoUser)) {
            $command = "sudo -u " . $this->sudoUser . " " . $command;
        }

        echo $command . PHP_EOL;
        system($command, $frontendExitCode);

        $commandMask = "rm -rf %s/backend/web/assets/*";
        $command = sprintf($commandMask, Yii::$app->params['deploymentPath']);

        if (!empty($this->sudoUser)) {
            $command = "sudo -u " . $this->sudoUser . " " . $command;
        }

        echo $command . PHP_EOL;
        system($command, $backendExitCode);

        return ($frontendExitCode === 0) && ($backendExitCode === 0);
    }

    /**
     * Full update environment
     */
    public function actionIndex()
    {
//        $this->actionDependency() or die('[!] Error: can\'t update dependencies.');
        $this->actionCopy() or die('[!] Error: can\'t copy files.');
        $this->actionMigrate() or die('[!] Error: can\'t apply migrations.');
        $this->actionReset() or die('[!] Error: can\'t remove temporary files.');
    }

    /**
     * @param Server $server
     * @return bool
     */
    protected function actionRemoteCopy($server)
    {
        $commandArgs = [
            "-av",
            "--owner",
            "--group",
            "--ignore-times",
            "--checksum",
            "--links",
            "--perms",
            "--recursive",
            "--delete",
            "--size-only",
            "--force",
            "--numeric-ids",
            "--stats",
            "--exclude .git",
            "--exclude .htpasswd",
            "--exclude frontend/runtime",
            "--exclude backend/runtime",
            "--exclude frontend/web/assets",
            "--exclude backend/web/assets",
            "--exclude frontend/web/uploads",
            "--exclude backend/web/uploads",
            "--exclude common/config/params-local.php",
            "--exclude common/config/main-local.php",
            "--exclude console/config/params-local.php",
            "--exclude console/config/main-local.php",
            "--exclude frontend/config/params-local.php",
            "--exclude frontend/config/main-local.php",
            "--exclude backend/config/params-local.php",
            "--exclude backend/config/main-local.php",
        ];

        $commandMask = "rsync " . implode(" ", $commandArgs) . " %s %s/";

        $command = sprintf(
            $commandMask,
            __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "..",
            $server->user . "@" . $server->host . ":" . $server->path
        );

        echo $command . PHP_EOL;
        system($command, $exitCode);

        if ($exitCode !== 0) {
            echo "[!] Error: " . $command . PHP_EOL;
        }

        return $exitCode === 0;
    }

    /**
     * @param Server $server
     * @return bool
     */
    protected function actionRemoteMigrate($server)
    {
        $commandMask = "php %s/yii migrate/up --interactive=0";
        $command = sprintf($commandMask, $server->path);

        $sshMask = "ssh %s@%s %s";
        $command = sprintf($sshMask, $server->user, $server->host, $command);

        echo $command . PHP_EOL;
        system($command, $backendExitCode);

        if ($backendExitCode !== 0) {
            echo "[!] Error: " . $command . PHP_EOL;
        }

        return $backendExitCode === 0;
    }

    /**
     * @param Server $server
     * @return bool
     */
    protected function actionRemoteReset($server)
    {
        $commandMask = "rm -rf %s/frontend/web/assets/*";
        $command = sprintf( $commandMask, $server->path);

        $sshMask = "ssh %s@%s %s";
        $command = sprintf($sshMask, $server->user, $server->host, $command);

        echo $command . PHP_EOL;
        system($command, $frontendExitCode);

        if ($frontendExitCode !== 0) {
            echo "[!] Error: " . $command . PHP_EOL;
        }

        $commandMask = "rm -rf %s/backend/web/assets/*";
        $command = sprintf($commandMask, $server->path);

        $sshMask = "ssh %s@%s %s";
        $command = sprintf($sshMask, $server->user, $server->host, $command);

        echo $command . PHP_EOL;
        system($command, $backendExitCode);

        if ($backendExitCode !== 0) {
            echo "[!] Error: " . $command . PHP_EOL;
        }

        return ($backendExitCode === 0) && ($frontendExitCode === 0);
    }

    /**
     * Full deploy project to remote nodes
     */
    public function actionDeployToRemoteNodes()
    {
        /** @var Server[] $servers */
        $servers = Server::find()->all();

        foreach ($servers as $server) {
            $this->actionRemoteCopy($server);
            $this->actionRemoteMigrate($server);
            $this->actionRemoteReset($server);
        }
    }
}
