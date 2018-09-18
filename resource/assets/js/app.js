$(function() {
    // 读取body data-type 判断是哪个页面然后执行相应页面方法，方法在下面。
    var dataType = $('body').attr('data-type');
    for (key in pageData) {
        if (key == dataType) {
            pageData[key]();
        }
    }
    //     // 判断用户是否已有自己选择的模板风格
    //    if(storageLoad('SelcetColor')){
    //      $('body').attr('class',storageLoad('SelcetColor').Color)
    //    }else{
    //        storageSave(saveSelectColor);
    //        $('body').attr('class','theme-black')
    //    }

    autoLeftNav();
    $(window).resize(function() {
        autoLeftNav();
    });

    //    if(storageLoad('SelcetColor')){

    //     }else{
    //       storageSave(saveSelectColor);
    //     }
})


// 页面数据
var pageData = {
    // ===============================================
    // 首页
    // ===============================================
    'index': function indexData() {
        // $('#example-r').DataTable({

        //     bInfo: false, //页脚信息
        //     dom: 'ti'
        // });
    },

}


// 风格切换

$('.tpl-skiner-toggle').on('click', function() {
    $('.tpl-skiner').toggleClass('active');
})

$('.tpl-skiner-content-bar').find('span').on('click', function() {
    $('body').attr('class', $(this).attr('data-color'))
    saveSelectColor.Color = $(this).attr('data-color');
    // 保存选择项
    storageSave(saveSelectColor);

})




// 侧边菜单开关


function autoLeftNav() {



    $('.tpl-header-switch-button').on('click', function() {
        if ($('.left-sidebar').is('.active')) {
            if ($(window).width() > 1024) {
                $('.tpl-content-wrapper').removeClass('active');
            }
            $('.left-sidebar').removeClass('active');
        } else {

            $('.left-sidebar').addClass('active');
            if ($(window).width() > 1024) {
                $('.tpl-content-wrapper').addClass('active');
            }
        }
    })

    if ($(window).width() < 1024) {
        $('.left-sidebar').addClass('active');
    } else {
        $('.left-sidebar').removeClass('active');
    }
}


$(document).ready(function() {
    // 侧边菜单
    $('.sidebar-nav-sub-title').on('click', function() {
        $(this).siblings('.sidebar-nav-sub').slideToggle(80)
            .end()
            .find('.sidebar-nav-sub-ico').toggleClass('sidebar-nav-sub-ico-rotate');
    })

    $('.datetimepicker-btn').datetimepicker();

    $('.error-remove').error(function() {
        $(this).remove();
    });

    $('.form-img').on('change', function() {
        var fileNames = '';
        $.each(this.files, function() {
            fileNames += '<span class="am-badge">' + this.name + '</span> ';
        });
        $(this).parents(".am-form-file").next('.file-list').html(fileNames);
    });

    $('.form-editor').each(function(index, el) {
        if(!window.wangEditor){
            $.ajax({
                url: adminApp.path.assets + '/wangEditor/wangEditor.min.js',
                async: false,
                dataType: 'script'
            });
        }
        var E = window.wangEditor
        var editor = new E($(this)[0])
        var name = $(this).attr('data-name') || 'content';
        var content = $(this).after('<textarea name="' + name + '" style="display:none;"></textarea>');
        var $text = $(this).next('textarea[name=' + name + ']')

        editor.customConfig.onchange = function (html) {    
            $text.val(html)
        }
        editor.create()
        $text.val(editor.txt.html())
    });

    $(window).resize(function(event) {
        var needHeight = $(this).height() - $(".admin-header").height() - $(".admin-footer").height();
        var minHeight = Math.max($(".content-wrapper").height() , needHeight)
        $(".content-wrapper").css('min-height',minHeight);
    });
    $(window).trigger("resize");    
});