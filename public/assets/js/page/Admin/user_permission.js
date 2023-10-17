function perm_function(ch1,action,comp_id)
{
    if(action=='all')
    {
        var perm_sub1=document.getElementsByClassName(comp_id+"_sub");
        for(let i1=0;i1<perm_sub1.length;i1++)
        {
            document.getElementById(perm_sub1[i1].id+"_all").checked=ch1;
            var perm_option_id_selected1=document.getElementsByClassName(perm_sub1[i1].id+"_opt");
            for(let i2=0;i2<perm_option_id_selected1.length;i2++)
            {perm_option_id_selected1[i2].checked=ch1;}
        }
    }
    else if(action=='all_sub')
    {
        var perm_option_id_selected1=document.getElementsByClassName(comp_id+"_opt");
        for(let i2=0;i2<perm_option_id_selected1.length;i2++)
        {perm_option_id_selected1[i2].checked=ch1;}
        init_fun();
    }
}
function init_fun()
{
    var perm_main1=document.getElementsByClassName("perm_main");
    for(let i0=0;i0<perm_main1.length;i0++)
    {
        var perm_main_id=perm_main1[i0].id;
        var ch_all=true;
        var perm_sub1=document.getElementsByClassName(perm_main_id+"_sub");
        for(let i1=0;i1<perm_sub1.length;i1++)
        {
            var perm_sub_id=perm_sub1[i1].id;
            var ch_opt=true;
            var perm_option_id_selected1=document.getElementsByClassName(perm_sub_id+"_opt");
            for(let i2=0;i2<perm_option_id_selected1.length;i2++)
            {ch_opt=perm_option_id_selected1[i2].checked;if(!ch_opt){break;}}
            document.getElementById(perm_sub_id+"_all").checked=ch_opt;
            if(ch_all){ch_all=ch_opt;}
        }
        document.getElementById(perm_main_id+"_all").checked=ch_all;
    }
}
function refresh_model(user_type_id,user_type)
{
    $('#bd-example-modal-lg1').modal('hide');
    open_model(user_type_id,user_type);
}
function open_model(user_type_id,user_type)
{
  var _token=$("#_token1").val();
  $('#bd-example-modal-lg1 #model_main_content').html("...");
  var sendInfo={"_token":_token,"action":"retrieve","user_type_id":user_type_id,"user_type":user_type,"user_rights_edit_1":user_rights_edit_1,"user_rights_delete_1":user_rights_delete_1};
  $.ajax({
    type: "POST",
    url: $("#CUR_ACTION").val(),
    data: sendInfo,
    success: function(data){
      $('#bd-example-modal-lg1').modal('show');
      $('#bd-example-modal-lg1 #myLargeModalLabel').html("Update Permission");
      $('#bd-example-modal-lg1 #model_main_content').html(data);
    },
    error: function() {
      alert('error handing here');
    }
  });
}
function update_perm(user_type_id,user_type)
{
    if(user_type_id===""){return false;}
    $("#update_submit_btn").attr("class","btn disabled btn-primary btn-progress");
    var perm_valu=[];
    var perm_main1=document.getElementsByClassName("perm_main");
    for(let i0=0;i0<perm_main1.length;i0++)
    {
        var perm_sub1=document.getElementsByClassName(perm_main1[i0].id+"_sub");
        for(let i1=0;i1<perm_sub1.length;i1++)
        {
            var perm_sub_id=perm_sub1[i1].id;
            var perm_option_ids=document.getElementById(perm_sub_id+"_option_ids").value;
            var perm_option_id_selected=[];
            var perm_option_id_selected1=document.getElementsByClassName(perm_sub_id+"_opt");
            for(let i2=0;i2<perm_option_id_selected1.length;i2++)
            {
                if(perm_option_id_selected1[i2].checked)
                {perm_option_id_selected.push(perm_option_id_selected1[i2].value);}
            }
            var perm_option_id_selected=perm_option_id_selected.toString();
            var perm_sub_id1=perm_sub_id.split("_");
            perm_valu.push([perm_sub_id1[1],perm_sub_id1[2],perm_sub_id1[3],perm_option_ids,perm_option_id_selected]);
        }
    }
    var _token=$("#_token1").val();
    var sendInfo={"action":"update_perm","_token":_token,"user_type_id":user_type_id,"perm_valu":perm_valu};
    $.ajax({
      type: "POST",
      url: $("#CUR_ACTION").val(),
      data: sendInfo,
      success: function(data){
        $("#update_submit_btn").attr("class","btn btn-primary");
        swal('Permissions Updated Successfully', {icon: 'success',}).then((data) => {
            window.location = window.location.href.split('?')[0]+"?user_type_id="+user_type_id+"&user_type="+user_type;
        });
      },
      error: function() {
        alert('error handing here');
        $("#update_submit_btn").attr("class","btn btn-primary");
      }
    });
}
function open_rights_model(user_type_id,user_type)
{
  var _token=$("#_token1").val();
  $('#bd-example-modal-lg1 #model_main_content').html("...");
  var sendInfo={"_token":_token,"action":"rights_form","user_type_id":user_type_id,"user_type":user_type,"user_rights_edit_1":user_rights_edit_1,"user_rights_delete_1":user_rights_delete_1};
  $.ajax({
    type: "POST",
    url: $("#CUR_ACTION").val(),
    data: sendInfo,
    success: function(data){
      $('#bd-example-modal-lg1').modal('show');
      $('#bd-example-modal-lg1 #myLargeModalLabel').html("Update Screen Rights Option");
      $('#bd-example-modal-lg1 #model_main_content').html(data);
    },
    error: function() {
      alert('error handing here');
    }
  });
}
