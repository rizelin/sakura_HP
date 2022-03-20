//버튼으로 텍스트필드 추가하는 자바스크립트
var arrInput = new Array(0);
var arrInputValue = new Array(0);
function addInput() {
    arrInput.push(arrInput.length);
    arrInputValue.push("");
    display();
}
function display() {
    document.getElementById('parah').innerHTML="";
    for (intI=0;intI<arrInput.length;intI++) {
        document.getElementById('parah').innerHTML+=createInput(arrInput[intI], arrInputValue[intI]);
    }
}
function saveValue(intId,strValue) {
    arrInputValue[intId]=strValue;
}
//추가할 내용
function createInput(id,value) {
    return "<div class='write_form'><dl><input type='hidden' name='schedule_id[]' value=''><dt><h3 class='write_name sub_text'>スケジュール<h3></dt></dl><dl><dt><label class='write_name' for='schedule_title'>タイトル</label></dt><dd><input id='title' type='text' name='schedule[title][]' value=''></dd></dl><dl><dt><label class='write_name write_text' for='schedule_address'>開催地</label></dt><dd><textarea class='write_address' id='schedule_address' name='schedule[address][]'></textarea></dd></dl><dl><dt><label class='write_name' for='schedule_entry_fee'>入場料</label></dt><dd><input class='write_input' id='schedule_entry_fee' type='text' name='schedule[entry_fee][]' value=''></dd></dl><dl><dt><label class='write_name' for='start_time'>日付日時</label></dt><dd><input class='write_input date_size' type='date' name='schedule_datetime[start_date][]' value=''> <input class='write_input date_size' type='time' name='schedule_datetime[start_time][]' value=''> ~ <input class='write_input date_size' type='time' name='schedule_datetime[end_time][]' value=''></dd></dl><dl><dt><label class='write_name' for='schdule_status'>公開範囲</label></dt><dd><select class='status' name='schedule[status][]'><option value='1'>公開</option><option value='2'>非公開</option></select></dd></dl></div>";
}

function deleteInput() {
    if (arrInput.length > 0) {
        arrInput.pop();
        arrInputValue.pop();
    }
    display();
}
