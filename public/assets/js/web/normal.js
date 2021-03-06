$(function(){
    bootstrapEvent();
    mailEvent();
    getCard();
});

function bootstrapEvent() {
    // carousel
    $('.myCarousel').carousel();
}

var card_list;
var card_detail;

function getCard() {
    var parent_id = $('#parent_id').val();
    var child_id = $('#child_id').val();

    $.get('/api/card/list/' + parent_id + '/' + child_id, function(result) {
        if(result.length == 0) {
            toastr['warning']('此分類暫無卡片，敬請期待');
        }
        console.log(result);
        card_list = result;

        produceCard();
    });
}

function produceCard() {
    var text;
    var i;
    var j;
    var card_id;
    var card_name;
    var mail_times;
    var share_times;
    var imgClass='featurette-image img-responsive center-block thumb';

    text = '<div class="row">';
    for(i=0; i<card_list.length;) {
        for(j=0; j<3 && i<card_list.length; j++, i++) {
            card_id = card_list[i].id;
            card_name = card_list[i].name;
            mail_times = card_list[i].mail_times;
            share_times = card_list[i].share_times;

            text += '<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">';
            text += '<div class="thumbnail">';
            text += `<a data-toggle="modal" data-target="#card" class="list" data-card_id="${card_id}">`;
            text += `<img class="${imgClass}" src="/card/web/${card_id}">`;
            text += '</a>';
            text += '<div class="caption">';
            text += `<h3 style="font-size: 120%;" class="text-center">${card_name}</h3>`;
            text += `<p class="text-center"><i class="fa fa-heart text-danger" aria-hidden="true"></i>&nbsp;<span class="text-muted">${mail_times}</span>&nbsp;&nbsp;&nbsp;`;
            text += `<i class="fa fa-star text-warning" aria-hidden="true"></i>&nbsp;<span class="text-muted">${mail_times}</span>&nbsp;&nbsp;&nbsp;`;
            text += `<i class="fa fa-paper-plane text-success" aria-hidden="true"></i>&nbsp;<span class="text-muted">${mail_times}</span>&nbsp;&nbsp;&nbsp;`;
            text += `<i class="fa fa-share text-primary" aria-hidden="true"></i>&nbsp;<span class="text-muted">${share_times}</span></p>`;
            text += '</div>';//end caption
            text += '</div>';//end thumbnail
            text += '</div>';
        }
    }
    text += '</div>';
    $('#cardContainer').append(text);

    cardEvent();
}

function cardEvent() {
    $('.list').click(function() {
        var id = $(this).data('card_id');

        $.get('/api/card/detail/' + id, function(result) {
            console.log(result);

            // current Card
            $('#currentCardId').val(id);

            // insert Modal
            $('#cardTitle').text(result.name);
            $('#cardName').text(result.name);
            $('#mailTime').text(result.mail_times);
            $('#shareTime').text(result.share_times);
            $('#cardDescription').text(result.description);
            $('#cardAuthor').text(result.author);
            $('#modalCard').attr('src', '/card/web/' + id);

            // reset type
            $('.nav-tabs li').removeClass('active');
            $('.nav-tabs li:first').addClass('active');
            $('#mailBtn').show();

            // tab appear
            $('#tab_information').show();
            $('#tab_multi_send').hide();
            $('#tab_reservation_send').hide();
            $('#tab_send').hide();

            $('#reservationWrapper').hide();
            $('#reservationBtn').hide();
            $('#multiWrapper').hide();
            $('#multiBtn').hide();
            $('#mailBtn').hide();
            $('#reciever_email_Wrapper').hide();
            $('#reciever_name_Wrapper').hide();
            $('#reciever_message_Wrapper').hide();

        })
        $.get('/api/card/collectDetail/' + id, function(collectResult) {
            console.log(collectResult);

            // current Card
            $('#currentCardId').val(id);

            // insert Modal
            $('#collectTime').text(collectResult);
        })
        $.get('/api/card/likeDetail/' + id, function(likeResult) {
            console.log(likeResult);

            // current Card
            $('#currentCardId').val(id);

            // insert Modal
            $('#likeTime').text(likeResult);
        })
    })



    $('.shareFB').unbind('click');
    $('.shareFB').click(function() {
        var from = $(this).data('from');
        var id;
        if(from == 'modal') {
            id = $('#currentCardId').val();
        }

        console.log(id);
        FB.ui({
            method: 'share',
            href: 'http://ecard.csie.io/web/card/' + id + '/FB/NONE'
        });

        $.post('/api/card/fb_share_increment/' + id, function(result) {

        }).fail(function() {

        });
    });

    $('.like').unbind('click');
    $('.like').click(function() {
        var from = $(this).data('from');
        var id, likeCount;
        if(from == 'modal') {
            id = $('#currentCardId').val();
        }

        console.log(id);

        $.post('/api/card/like_increment/' + id, function(result) {

            $.get('/api/card/likeDetail/' + id, function(likeResult) {
                console.log(likeResult);
                // insert Modal
                $('#likeTime').text(likeResult);
                console.log(likeResult);
                likeCount = likeResult;
            });

        }).fail(function() {

        });


    });
    $('.collect').unbind('click');
    $('.collect').click(function() {
        var from = $(this).data('from');
        var id, collectCount;
        if(from == 'modal') {
            id = $('#currentCardId').val();
        }

        console.log(id);

        $.post('/api/card/collect_increment/' + id, function(result) {

            $.get('/api/card/collectDetail/' + id, function(collectResult) {
                console.log(collectResult);
                // insert Modal
                $('#collectTime').text(collectResult);
                console.log(collectResult)
                collectCount = collectResult;
            });

        }).fail(function() {

        });


    });

    $('.nav-tabs li').unbind('click');
    $('.nav-tabs li').click(function() {
        var type = $(this).attr('data-type');
        var nameWrapper = $('#reciever_name').parent();
        var emailWrapper = $('#reciever_email').parent();

        $('.nav-tabs li').removeClass('active');
        $(this).addClass('active');

        if(type == 'information') {
            $('#informationWrapper').show();
            $('#tab_information').show();

            $('#tab_multi_send').hide();
            $('#tab_reservation_send').hide();
            $('#tab_send').hide();

            $('#reservationWrapper').hide();
            $('#reservationBtn').hide();
            $('#mailBtn').hide();
            $('#multiBtn').hide();
            $('#multiWrapper').hide();
            $('#reciever_email_Wrapper').hide();
            $('#reciever_name_Wrapper').hide();
            $('#reciever_message_Wrapper').hide();

        }else if(type == 'reservation') {

            $('#tab_reservation_send').show();

            $('#reservationWrapper').show();
            $('#reservationBtn').show();
            $('#reciever_email_Wrapper').show();
            $('#reciever_name_Wrapper').show();
            $('#reciever_message_Wrapper').show();
            nameWrapper.show();
            emailWrapper.show();


            $('#mailBtn').hide();
            $('#multiBtn').hide();
            $('#multiWrapper').hide();
            $('#informationWrapper').hide();

            $('#tab_information').hide();
            $('#tab_multi_send').hide();
            $('#tab_send').hide();

        }else if(type == 'normal'){

            $('#tab_send').show();

            $('#mailBtn').show();
            $('#reciever_email_Wrapper').show();
            $('#reciever_name_Wrapper').show();
            $('#reciever_message_Wrapper').show();
            nameWrapper.show();
            emailWrapper.show();

            $('#tab_information').hide();
            $('#tab_multi_send').hide();
            $('#tab_reservation_send').hide();

            $('#reservationWrapper').hide();
            $('#reservationBtn').hide();
            $('#multiBtn').hide();
            $('#multiWrapper').hide();
            $('#informationWrapper').hide();

        }else if(type == 'multi'){

            $('#tab_multi_send').show();


            $('#multiBtn').show();
            $('#multiWrapper').show();
            $('#reciever_message_Wrapper').show();

            $('#tab_information').hide();
            $('#tab_reservation_send').hide();
            $('#tab_send').hide();

            $('#mailBtn').hide();
            $('#reservationWrapper').hide();
            $('#reservationBtn').hide();
            $('#informationWrapper').hide();
            $('#reciever_email_Wrapper').hide();
            $('#reciever_name_Wrapper').hide();
            nameWrapper.hide();
            emailWrapper.hide();

        }
    });
}

function mailEvent() {
    $('#mailBtn').unbind('click');
    $('#mailBtn').click(function() {
        var id = $('#currentCardId').val();
        var validateEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var data = {};
        /*data.reciever_name = $('#reciever_name').val();
        data.reciever_email = $('#reciever_email').val();*/
        data.message = $('#message').val();
        data.contact = $('#contactSelect').val();

        /*if(_.trim(data.reciever_name) == '' || _.trim(data.reciever_email) == '') {
            toastr['warning']('信箱跟姓名欄位都要填');
            return;
        }

        if(!validateEmail.test(data.reciever_email)) {
            toastr['warning']('信箱格式不合');
            return;
        }*/

        if(_.trim(data.message) == '') {
            toastr['warning']('請至少選擇一位聯絡人');
            return;
        }

        console.log(data);
        $.post('/api/card/mail/' + id, data, function(result) {
            console.log(result);
            toastr['success']('寄信成功');
        }).fail(function() {
            toastr['error']('寄信失敗');
        });
    });

    $('#reservationBtn').unbind('click');
    $('#reservationBtn').click(function() {
        var id = $('#currentCardId').val();
        //var validateEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var data = {};
        /*data.reciever_name = $('#reciever_name').val();
        data.reciever_email = $('#reciever_email').val();*/
        data.contact = $('#contactSelect').val();
        data.message = $('#message').val();
        data.mail_time = `${$('#reservation_date').val()} ${$('#hour')}:00:00`;

        /*if(_.trim(data.reciever_name) == '' || _.trim(data.reciever_email) == '') {
            toastr['warning']('信箱跟姓名欄位都要填');
            return;
        }

        if(!validateEmail.test(data.reciever_email)) {
            toastr['warning']('信箱格式不合');
            return;
        }*/

        if(_.trim(data.message) == '') {
            toastr['warning']('訊息欄位沒填');
            return;
        }

        console.log(data);
        $.post('/api/person/reservation/create/' + id, data, function(result) {
            console.log(result);
            toastr['success']('預約成功');
        }).fail(function() {
            toastr['error']('預約失敗');
        });
    });

    $('#multiBtn').unbind('click');
    $('#multiBtn').click(function() {
        var id = $('#currentCardId').val();
        var data = {};
        data._token = $('meta[name="csrf-token"]').attr('content');
        data.message = $('#message').val();

        if($('#excel')[0].files[0] == null) {
            toastr['warning']('需選擇檔案');
            return;
        }

        if(_.trim(data.message) == '') {
            toastr['warning']('訊息欄位沒填');
            return;
        }

        console.log(data);
        $('#mailForm').ajaxSubmit({
            url: '/api/card/multiMail/' + id,
            method: 'POST',
            data: data,
            success: function(result) {
                console.log(result);
                toastr['success']('大量寄送成功');
            },
            fail: function() {
                toastr['error']('解析excel失敗');
            }
        });
    });
}
