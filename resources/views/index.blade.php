<style>
    .web-uploader{
        margin-top: 0;
    }
    {!! $selector !!} .file-picker .webuploader-pick{
        padding: 0;
        border: none;
        box-shadow: none;
        background: none;
        line-height: 1.2;
    }
    .web-uploader .placeholder .flashTip a {
        color: @primary(-10);
    }

    .web-uploader .statusBar .upload-progress span.percentage,
    .web-uploader .filelist li p.upload-progress span {
        background: @primary(-8);
    }

    .web-uploader .dnd-area.webuploader-dnd-over {
        border: 3px dashed #999 !important;
    }
    .web-uploader .dnd-area.webuploader-dnd-over .placeholder {
        border: none;
    }

</style>

<div class="{{$viewClass['form-group']}} {{ $class }} form-media form-media-{{ str_replace(['[', ']'], ['-', ''], $name) }}"
     data-name="{{ str_replace(['[', ']'], ['-', ''], $name) }}"
     data-options="{{ json_encode($formOptions) }}">

    <label for="{{$column}}" class="{{$viewClass['label']}} control-label">{!! $label !!}</label>

    <div class="{{$viewClass['field']}} web-uploader {{ $fileType }}">

        <div class="form-media-img-show" style="display: none;">
            <div class="row form-media-img-show-row" >
            </div>
        </div>

        @include('admin::form.error')
        <div class="input-group">
            <input name="{{ $name }}" class="file-input form-control form-media-input" {!! $attributes !!}/>
            <div class="input-group-btn input-group-append">
                <label class="btn btn-custom form-media-btn-file" data-target="LakeFormMediaModel{{ str_replace(['[', ']'], ['-', ''], $name) }}" type="button" data-title="{{ $label }}"
                       data-token="{{ csrf_token() }}" style="white-space: nowrap;">
                    <i class="feather icon-folder"></i>&nbsp;&nbsp;{{trans('admin.browse')}}
                </label>
                <label class="btn btn-primary file-picker"></label>
            </div>
        </div>
        <div class="statusBar" style="display:none;">
            <div class="upload-progress progress progress-bar-primary pull-left">
                <div class="progress-bar progress-bar-striped active" style="line-height:18px">0%</div>
            </div>
            <div class="info"></div>
{{--            <div class="btns">--}}
{{--                <div class="add-file-button"></div>--}}
{{--                @if($showUploadBtn)--}}
{{--                    &nbsp;--}}
{{--                    <div class="upload-btn btn btn-primary"><i class="feather icon-upload"></i> &nbsp;{{trans('admin.upload')}}</div>--}}
{{--                @endif--}}
{{--            </div>--}}
        </div>
        @include('admin::form.help-block')
        <div id="LakeFormMediaModel{{ str_replace(['[', ']'], ['-', ''], $name) }}Body" >
            <div class="modal fade form-media-modal"
                 tabindex="-1"
                 role="dialog"
                 data-idkey="{{ str_replace(['[', ']'], ['-', ''], $name) }}"
                 data-media="form-media-{{ str_replace(['[', ']'], ['-', ''], $name) }}"
                 aria-labelledby="LakeFormMediaModalLabel"
            >
                <div class="modal-dialog" role="document">
                    <div class="modal-content"  style="width: 100%">
                        <div class="modal-header">
                            <h4 class="modal-title" id="LakeFormMediaModalLabel">{{trans('admin.choose')}}{{$label}}</h4>
                            <button type="button"
                                    class="close form-media-close"
                                    data-modal="LakeFormMediaModel{{ str_replace(['[', ']'], ['-', ''], $name) }}"
                                    aria-label="Close"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="mailbox-controls with-border form-media-actions-label" style="margin-left: 10px;">

                            <label class="btn btn-light form-media-modal-order"
                                   data-order="time"
                            >
                                <i class="fa fa-calendar-times-o"></i>
                            </label>

                        </div>

                        <div class="modal-body pre-scrollable" >
                            <!-- 页面导航 -->
                            <ol class="breadcrumb form-media-nav-ol" data-current-path="/" style="margin-bottom: 10px;">
                                <li class="breadcrumb-item form-media-nav-li">
                                    加载中...
                                </li>
                            </ol>

                            <!-- 图片 -->
                            <div class="row form-media-body-table">
                                <!-- js 加载 -->
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default form-media-close" data-modal="LakeFormMediaModel{{ str_replace(['[', ']'], ['-', ''], $name) }}">{{ trans('admin.close') }}</button>
                            <button type="button" class="btn btn-primary form-media-submit">{{ trans('admin.save') }}</button>
                        </div>

                        <!-- 分页 -->
                        <div class="form-media-modal-page"
                             data-current-page="1"
                             data-page-size="{{ $formOptions['pagesize'] }}"
                             data-total-page="0"
                        >
                            <button type="button" class="btn btn-primary hidden form-media-modal-prev-page">{{ trans('admin.prev') }}</button>
                            <button type="button" class="btn btn-primary hidden form-media-modal-next-page">{{ trans('admin.next') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script require="@webuploader" init="{!! $selector !!}">
    var uploader,
        newPage,
        options = {!! $options !!},
        events = options.events;

    init();

    function init() {
        var opts = $.extend({
            selector: $this,
            // addFileButton: $this.find('.add-file-button'),
            inputSelector: $this.find('.file-input'),
        }, options);

        opts.upload = $.extend({
            pick: {
                id: $this.find('.file-picker'),
                name: '_file_',
                label: '<i class="feather icon-upload"></i>&nbsp;&nbsp;{{trans('admin.upload')}}'
            },
        }, opts);
        uploader = Dcat.Uploader(opts);
        uploader.build();
        uploader.preview();

        if(options.fileNumLimit===1){
            uploader.uploader.on('startUpload',function(){
                $this.find('.file-input').val('')
            })
        }
        uploader.uploader.on('uploadFinished',function(){
            let file = uploader.addUploadedFile.uploadedFiles;
            for(let i in file){
                uploader.uploader.removeFile(file[i])
            }
            uploader.addUploadedFile.uploadedFiles = []
        })
        for (var i = 0; i < events.length; i++) {
            var evt = events[i];
            if (evt.event && evt.script) {
                if (evt.once) {
                    uploader.uploader.once(evt.event, evt.script.bind(uploader))
                } else {
                    uploader.uploader.on(evt.event, evt.script.bind(uploader))
                }
            }
        }


        function resize() {
            setTimeout(function () {
                if (! uploader) return;

                uploader.refreshButton();
                resize();

                if (! newPage) {
                    newPage = 1;
                    $(document).one('pjax:complete', function () {
                        uploader = null;
                    });
                }
            }, 250);
        }
        resize();
    }
    $this.find('.form-media-input').each(function(i, cont){
        LakeFormMedia.refreshInputPreview(cont);
    })
</script>
