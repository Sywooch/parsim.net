var macro;

macro = "CODE:";


//Пыьаюсь залогиниться
macro += "URL GOTO=http://admin.digdesk.dev/parser/task\n";
macro += "TAG POS=1 TYPE=INPUT:TEXT FORM=ID:login-form ATTR=ID:loginform-email CONTENT=ptimofeev@yandex.ru\n";
retcode = iimPlay(macro);


if (retcode ==1){
    //Если логин форма найдена, логинюсь
    macro = "CODE:";
    //macro += "SET !ERRORIGNORE YES\n";
    macro += "SET !ENCRYPTION NO\n";    
    macro += "TAG POS=1 TYPE=INPUT:PASSWORD FORM=ID:login-form ATTR=ID:loginform-password CONTENT=12345678\n";
    macro += "TAG POS=1 TYPE=BUTTON FORM=ID:login-form ATTR=NAME:login-button\n";
    retcode = iimPlay(macro);
}

//Открываю первую ссылку и перехажу по URL
macro = "CODE:";
macro += "TAG POS=1 TYPE=A ATTR=CLASS:task-id EXTRACT=TXT\n";
retcode = iimPlay(macro);
var id = iimGetLastExtract();
//alert(id);

macro = "CODE:";
macro += "TAG POS=1 TYPE=A ATTR=NAME:btn-upload \n";
//macro += "TAG POS=1 TYPE=HTML ATTR=* EXTRACT=HTM\n"; //забираю html content
macro += "WAIT SECONDS=3\n";
macro += "SAVEAS TYPE=HTM FOLDER=* FILE="+id+"\n";
retcode = iimPlay(macro);

iimClose();

//var html = iimGetLastExtract();
//html=html.replace(/'/g, '"');

//alert(html);

//macro = "CODE:";


//macro += "URL GOTO=http://admin.digdesk.dev/parser/task/update?id="+id+"\n";
//macro += 'TAG POS=1 TYPE=TEXTAREA FORM=ID:task-form ATTR=NAME:Task[content] CONTENT=\''+html+'\'\n';
//macro += "TAG POS=1 TYPE=BUTTON FORM=ID:task-form ATTR=TXT:Save\n";
//retcode = iimPlay(macro);













