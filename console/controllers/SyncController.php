<?php

namespace console\controllers;

use backend\models\Server;
use yii;
use yii\console\Controller;

/**
 * Class SyncController
 * @package console\controllers
 */
class SyncController extends Controller
{
    /**
     * @param string $key
     * @return string
     */
    public function actionIndex($key)
    {
        $connectionUrl = str_replace(":", "://host/?", Yii::$app->db->dsn);
        $connectionUrl = str_replace(";", "&", $connectionUrl);

        $params = parse_url($connectionUrl);

        parse_str($params['query'], $params);

        $host = $params['host'];
        $dbname = $params['dbname'];
        $user = Yii::$app->db->username;
        $password = Yii::$app->db->password;
        $file = sprintf(
            Yii::$app->getBasePath() . "/../frontend/web/backups/%s.sql",
            $key
        );

        $commandMask = "mysql -h%s -u%s -p%s %s < %s";
        $command = sprintf($commandMask, $host, $user, $password, $dbname, $file);

        echo $command . PHP_EOL;

        system($command, $exitCode);

        if($exitCode !== 0) {
            echo "[!] Error: " . $command . PHP_EOL;
        }

        Yii::$app->end($exitCode);
        die;
    }

    /**
     * Send backup to remote server node
     */
    public function actionSendBackup()
    {
        Server::updateAll(['state' => Server::STATE_IN_PROGRESS], ['state' => Server::STATE_NEED_SYNC]);

        /** @var Server[] $servers */
        $servers = Server::find()
            ->andFilterWhere(['state' => Server::STATE_IN_PROGRESS])
            ->all();

        $key = date("Y-m-d_h-i-s", time());

        foreach ($servers as $server) {
            // actions

            $file = sprintf(
                Yii::$app->getBasePath() . "/../frontend/web/backups/%s.sql",
                $key
            );

            if(!file_exists($file)) {
                $connectionUrl = str_replace(":", "://host/?", Yii::$app->db->dsn);
                $connectionUrl = str_replace(";", "&", $connectionUrl);

                $params = parse_url($connectionUrl);

                parse_str($params['query'], $params);

                $host = $params['host'];
                $dbname = $params['dbname'];
                $user = Yii::$app->db->username;
                $password = Yii::$app->db->password;


                $commandMask = "mysqldump -h%s -u%s -p%s %s > %s";
                $command = sprintf($commandMask, $host, $user, $password, $dbname, $file);

                echo $command . PHP_EOL;
                system($command, $exitCode);

                if ($exitCode !== 0) {
                    echo "[!] Error: " . $command . PHP_EOL;
                    $server->state = Server::STATE_SYNC_FAILED;
                    $server->save();
                    continue;
                }
            }

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
            ];

            $commandMask = "rsync " . implode(" ", $commandArgs) . " %s %s";
            $command = sprintf(
                $commandMask,
                Yii::$app->getBasePath() . "/../frontend/web/backups/" . $key . ".sql",
                $server->user . "@" . $server->host . ":" . $server->path . DIRECTORY_SEPARATOR . "frontend/web/backups/"
            );

            echo $command . PHP_EOL;
            system($command, $exitCode);

            if ($exitCode !== 0) {
                echo "[!] Error: " . $command . PHP_EOL;
                $server->state = Server::STATE_SYNC_FAILED;
                $server->save();
                continue;
            }

            $commandMask = "php %s/yii sync \"%s\"";
            $command = sprintf(
                $commandMask,
                $server->path,
                $key
            );

            $sshMask = "ssh %s@%s %s";
            $command = sprintf($sshMask, $server->user, $server->host, $command);

            echo $command . PHP_EOL;
            system($command, $exitCode);

            if ($exitCode !== 0) {
                echo "[!] Error: " . $command . PHP_EOL;
                $server->state = Server::STATE_SYNC_FAILED;
                $server->save();
                continue;
            }

            $server->state = Server::STATE_SYNCED;
            $server->save();
        }
    }
}
