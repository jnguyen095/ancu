function bindingChangeCaptchaEvent(){$("#changeCaptcha").click(function(){$("#captchaImg").html("<img src='/img/load.gif'/>"),jQuery.ajax({type:"POST",url:urls.loadCaptchaUrl,dataType:"json",success:function(t){$("#captchaImg").html(t[0].capchaImg)}})})}function changeIconMoreLess(t){"open"==t.data("status")?(t.html("Ít hơn"),t.data("status","close"),t.removeClass("toggleMore").addClass("toggleLess")):(t.html("Xem thêm"),t.data("status","open"),t.removeClass("toggleLess").addClass("toggleMore"))}function subscribleHandler(){$("#btnSubscrible").click(function(t){var a=$("#sbEmail").val();null!=a&&isValidEmail(a)?(ga("send",{hitType:"event",eventCategory:"Subscrible",eventAction:"Subscrible email",eventLabel:"Subscrible"}),jQuery.ajax({type:"POST",url:urls.addSubscribleUrl,dataType:"json",data:{email:a},success:function(t){"success"==t?$("#subcribleMes").html("<span class='subscrible-success'>Đăng ký theo dõi thành công.</span>"):$("#subcribleMes").html("<span class='subscrible-danger'>Email này đã tồn tại.</span>")}})):$("#subcribleMes").html("<span class='subscrible-danger'>Email không đúng định dạng.</span>")})}function isValidEmail(t){var a=/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;return a.test(t)}function loadSearchDistrictByCityId(){$("#cmCityId").change(function(){var t=$(this).val();jQuery.ajax({type:"POST",url:urls.loadDistrictByCityId,dataType:"json",data:{cityId:t},success:function(t){document.getElementById("cmDistrictId").options.length=1;for(key in t)$("#cmDistrictId").append("<option value='"+t[key].DistrictID+"'>"+t[key].DistrictName+"</option>")}})})}function socialLogin(t,a,n,e){jQuery.ajax({type:"POST",url:urls.social_login_url,dataType:"json",data:{username:t,password:a,fullname:n},success:e})}function submitSearchForm(){$("#btnSearch").click(function(){ga("send",{hitType:"event",eventCategory:"Search",eventAction:"Tìm kiếm",eventLabel:"Tìm kiếm"}),$("form#search_form").submit()})}function scrollFunction(){document.body.scrollTop>50||document.documentElement.scrollTop>50?$("#myBtn").show(1e3):$("#myBtn").hide(1e3)}function topFunction(){ga("send",{hitType:"event",eventCategory:"Go to Top",eventAction:"Go to Top",eventLabel:"Go to Top"}),$("html,body").animate({scrollTop:0},"slow")}function contactFormHandler(){$("#contactModalForm").click(function(){$.ajax({type:"POST",url:urls.base_url+"ajax_controller/contactFormHandler",data:null,success:function(t){$("#modalFormDialog").html(t);var a=$("#modalFormDialog");a.modal("show"),bindingChangeCaptchaEvent()}})})}function submitContactForm(){var t=$("#modalForm").serialize();$.ajax({type:"POST",url:urls.base_url+"ajax_controller/contactFormHandler",data:t,beforeSend:function(){$(".submitBtn").attr("disabled","disabled"),$(".modal-body").css("opacity",".5")},success:function(t){"success"==t?($("#fullName").val(""),$("#inputEmail").val(""),$("#inputPhone").val(""),$("#inputMessage").val(""),$("#txtCaptcha").val(""),$("#btnSendFeedBack").hide(),$(".statusMsg").html('<span style="color:green;">Gửi thành công, chúng tôi sẻ phản hồi ngay khi có thể.</p>')):$(".statusMsg").html('<span style="color:red;">'+t+"</span>"),$(".submitBtn").removeAttr("disabled"),$(".modal-body").css("opacity","")}})}$(document).ready(function(){$('[data-toggle="tooltip"]').tooltip(),loadSearchDistrictByCityId(),submitSearchForm(),subscribleHandler(),$(".toggleBtn").click(function(){changeIconMoreLess($(this))}),$("#myBtn").click(function(){topFunction()}),bindingChangeCaptchaEvent(),contactFormHandler()}),window.onscroll=function(){scrollFunction()};