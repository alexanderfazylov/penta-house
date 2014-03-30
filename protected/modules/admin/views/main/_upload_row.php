<li class="qq-upload-success" data-upload-id="{{>id}}">
    <span class="qq-progress-bar" style="width: 100%;"></span>
        <span class="qq-picter">
            <img src="/uploads/thumbs/{{notCacheImage:file_name}}">
        </span>
    <span class="qq-upload-file">
        <a href="/uploads/{{>file_name}}" target="_blank">{{>user_file_name}}</a>
    </span>
    <span class="qq-input-uplod">
        <input type="hidden" name="{{>model}}[{{>attribute}}]" value="{{>id}}"/>
    </span>
    <span class="qq-crop-upload">Кроп</span>
    <span class="qq-delete-upload">Удалить</span>
</li>
