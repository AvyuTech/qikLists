<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\AmazonCategory */
/* @var $form yii\widgets\ActiveForm */

$this->title = '';

?>
<?php $form = ActiveForm::begin(['id' => 'cs-contact-form', 'enableAjaxValidation' => true]); ?>
<div class="modal-header">
    <h3 class="modal-title">Contact Us</h3>
    <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>-->
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <?php
            echo $form->field($model, 'csu_services')->widget(\kartik\select2\Select2::classname(), [
                'data' => $model->getServices(),
                'options' => ['placeholder' => 'Select a Service(s) ...'],
                'pluginOptions' => [
                    'allowClear' => true,
                    'multiple' => true,
                ],
            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <?= $form->field($model, 'csu_extra_comment')->textarea(['rows' => 8]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <?= $form->field($model, 'csu_first_name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-12 col-sm-6">
            <?= $form->field($model, 'csu_last_name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <?= $form->field($model, 'csu_email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-12 col-sm-6">
            <?= $form->field($model, 're_enter_email')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12">
            <?= $form->field($model, 'csu_contact_no')->widget(\yii\widgets\MaskedInput::className(), [
                'mask' => '+1 999-999-9999',
            ]) ?>
        </div>
        <div class="col-xs-12 col-sm-12">
            <?= Html::hiddenInput('voice-file-name', null, ['class' => 'voice-file-name']); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12" style="padding-bottom: 10px;">
            <strong>Record Voice Message (If required):</strong>
        </div>
        <div class="col-xs-12 col-sm-3 text-center" style="padding-top: 15px;">
            <a id="btn-start-recording" class="" title="Start Recording"><i class="fa fa-2x fa-play-circle text-success"></i></a> &nbsp;&nbsp;
            <a id="btn-stop-recording" class="" disabled title="Stop & Save Recording"><i class="fa fa-2x fa-stop-circle text-danger"></i></a>
            <!--<button id="btn-download-recording" disabled>Download</button>-->
            <button id="btn-release-microphone" disabled style="display: none;">Release Microphone</button>
        </div>
        <div class="col-xs-12 col-sm-9">
            <div><audio controls></audio></div>
        </div>
        <div class="col-xs-12 col-sm-12">
            <b>Note:</b> Please allow microphone permission to record voice.
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-primary pull-left subBtn">Submit</button>
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
<?php ActiveForm::end(); ?>

<script>
    var audio = document.querySelector('audio');

    function captureMicrophone(callback) {
        //btnReleaseMicrophone.disabled = false;

        if(microphone) {
            callback(microphone);
            return;
        }

        if(typeof navigator.mediaDevices === 'undefined' || !navigator.mediaDevices.getUserMedia) {
            alert('This browser does not supports WebRTC getUserMedia API.');

            if(!!navigator.getUserMedia) {
                alert('This browser seems supporting deprecated getUserMedia API.');
            }
        }

        navigator.mediaDevices.getUserMedia({
            audio: isEdge ? true : {
                echoCancellation: false
            }
        }).then(function(mic) {
            callback(mic);
        }).catch(function(error) {
            alert('Unable to capture your microphone. Please check console logs.');
            console.error(error);
        });
    }

    function replaceAudio(src) {
        var newAudio = document.createElement('audio');
        newAudio.controls = true;

        if(src) {
            newAudio.src = src;
        }

        var parentNode = audio.parentNode;
        parentNode.innerHTML = '';
        parentNode.appendChild(newAudio);

        audio = newAudio;
    }

    function stopRecordingCallback() {
        replaceAudio(URL.createObjectURL(recorder.getBlob()));

        btnStartRecording.disabled = false;

        setTimeout(function() {
            if(!audio.paused) return;

            setTimeout(function() {
                if(!audio.paused) return;
                audio.play();
            }, 1000);

            audio.play();
        }, 300);

        audio.play();

       // btnDownloadRecording.disabled = false;

        if(isSafari) {
           // click(btnReleaseMicrophone);
        }

        saveVoice();
    }

    var isEdge = navigator.userAgent.indexOf('Edge') !== -1 && (!!navigator.msSaveOrOpenBlob || !!navigator.msSaveBlob);
    var isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);

    var recorder; // globally accessible
    var microphone;

    var btnStartRecording = document.getElementById('btn-start-recording');
    var btnStopRecording = document.getElementById('btn-stop-recording');
    //var btnReleaseMicrophone = document.querySelector('#btn-release-microphone');
    //var btnDownloadRecording = document.getElementById('btn-download-recording');

    btnStartRecording.onclick = function() {
        this.disabled = true;
        this.style.border = '';
        this.style.fontSize = '';

        if (!microphone) {
            captureMicrophone(function(mic) {
                microphone = mic;

                if(isSafari) {
                    replaceAudio();

                    audio.muted = true;
                    setSrcObject(microphone, audio);
                    audio.play();

                    btnStartRecording.disabled = false;
                    btnStartRecording.style.border = '1px solid red';
                    btnStartRecording.style.fontSize = '150%';

                    alert('Please click startRecording button again. First time we tried to access your microphone. Now we will record it.');
                    return;
                }

                click(btnStartRecording);
            });
            return;
        }

        replaceAudio();

        audio.muted = true;
        setSrcObject(microphone, audio);
        audio.play();

        var options = {
            type: 'audio',
            numberOfAudioChannels: isEdge ? 1 : 2,
            checkForInactiveTracks: true,
            bufferSize: 16384
        };

        if(navigator.platform && navigator.platform.toString().toLowerCase().indexOf('win') === -1) {
            options.sampleRate = 48000; // or 44100 or remove this line for default
        }

        if(recorder) {
            recorder.destroy();
            recorder = null;
        }

        recorder = RecordRTC(microphone, options);

        recorder.startRecording();

        btnStopRecording.disabled = false;
       // btnDownloadRecording.disabled = true;
    };

    btnStopRecording.onclick = function() {
        this.disabled = true;
        recorder.stopRecording(stopRecordingCallback);
    };

    /*btnReleaseMicrophone.onclick = function() {
        this.disabled = true;
        btnStartRecording.disabled = false;

        if(microphone) {
            microphone.stop();
            microphone = null;
        }

        if(recorder) {
            // click(btnStopRecording);
        }
    };*/

    function saveVoice() {
        this.disabled = true;
        if(!recorder || !recorder.getBlob()) return;

        if(isSafari) {
            recorder.getDataURL(function(dataURL) {
                SaveToDisk(dataURL, getFileName('mp3'));
            });
            return;
        }

        var blob = recorder.getBlob();
        var file = new File([blob], getFileName('mp3'), {
            type: 'audio/mp3'
        });

        var fileName = (Math.random() * 1000).toString().replace('.', '');
        var fileType = "audio";

        // create FormData
        var formData = new FormData();
        formData.append(fileType + '-filename', fileName);
        formData.append(fileType + '-blob', blob);

        xhr('<?= \yii\helpers\Url::to(['save-voice']); ?>', formData, function (fName) {
           // window.open(location.href + fName);
           $('.voice-file-name').val(fileName + '.wav');
        });

        function xhr(url, data, callback) {
            var request = new XMLHttpRequest();
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    callback(location.href + request.responseText);
                }
            };
            request.open('POST', url);
            request.send(data);
        }

        //invokeSaveAsDialog(file);
    };

    function click(el) {
        el.disabled = false; // make sure that element is not disabled
        var evt = document.createEvent('Event');
        evt.initEvent('click', true, true);
        el.dispatchEvent(evt);
    }

    function getRandomString() {
        if (window.crypto && window.crypto.getRandomValues && navigator.userAgent.indexOf('Safari') === -1) {
            var a = window.crypto.getRandomValues(new Uint32Array(3)),
                token = '';
            for (var i = 0, l = a.length; i < l; i++) {
                token += a[i].toString(36);
            }
            return token;
        } else {
            return (Math.random() * new Date().getTime()).toString(36).replace(/\./g, '');
        }
    }

    function getFileName(fileExtension) {
        var d = new Date();
        var year = d.getFullYear();
        var month = d.getMonth();
        var date = d.getDate();
        return 'RecordRTC-' + year + month + date + '-' + getRandomString() + '.' + fileExtension;
    }

    function SaveToDisk(fileURL, fileName) {
        // for non-IE
        if (!window.ActiveXObject) {
            var save = document.createElement('a');
            save.href = fileURL;
            save.download = fileName || 'unknown';
            save.style = 'display:none;opacity:0;color:transparent;';
            (document.body || document.documentElement).appendChild(save);

            if (typeof save.click === 'function') {
                save.click();
            } else {
                save.target = '_blank';
                var event = document.createEvent('Event');
                event.initEvent('click', true, true);
                save.dispatchEvent(event);
            }

            (window.URL || window.webkitURL).revokeObjectURL(save.href);
        }

        // for IE
        else if (!!window.ActiveXObject && document.execCommand) {
            var _window = window.open(fileURL, '_blank');
            _window.document.close();
            _window.document.execCommand('SaveAs', true, fileName || fileURL)
            _window.close();
        }
    }
</script>
