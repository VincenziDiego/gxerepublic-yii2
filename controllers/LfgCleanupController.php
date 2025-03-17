<?php

namespace app\controllers;

use Yii;
use yii\console\Controller;
use app\models\Lfg;

class LfgCleanupController extends Controller
{
    public function actionIndex()
    {
        // Trova tutti gli LFG chiusi (status = 0)
        $lfgs = Lfg::find()->where(['status' => 0])->all();
        $deletedCount = 0;
        foreach ($lfgs as $lfg) {
            // Se sono passati almeno 15 minuti (900 secondi) dallo start_time, elimina il record
            if ($lfg->start_time !== null && (strtotime($lfg->start_time) + 900) <= time()) {
                if ($lfg->delete() !== false) {
                    $deletedCount++;
                }
            }
        }
    }
}
