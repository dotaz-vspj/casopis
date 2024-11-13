function gotoarticle(id) {
    window.location.href = "article.php?id=" + id;
}

$('#document').on('change', function() {
    var fileName = this.files[0].name;
    var nextSibling = $(this).next();
    nextSibling.text(fileName);
});

$('#image').on('change', function() {
    var fileName = this.files[0].name;
    var nextSibling = $(this).next();
    nextSibling.text(fileName);
});

var style=-1;
var styles={0:{
        "list-out":["col-sm-3"],
        "main-out":["col"],
        "messages-out":["col-sm-2","mx-3","border","rounded-3"]},
            1:{
        "list-out":["col"],
        "main-out":[],
        "messages-out":["col-sm-6","mx-3","border","rounded-3"]},
            2:{
        "list-out":["col-sm-3"],
        "main-out":["col-sm-6","bg-primary"],
        "messages-out":["overlayed","col-sm-4","mx-3","bg-dark","border-double","border-3","rounded-2"]},
            3:{
        "list-out":["col-sm-3"],
        "main-out":["col","bg-primary"],
        "messages-out":[]}};

$( document ).ready(function () {
    articlesLoad(0,0);
    messagesLoad(0,0);
    setLayout(1);
});

function menuItemClick(index){
    console.log('Menu:'+index);
    if (index==1) {setLayout(0);}
    if (index==2) {messagesLoad(0,0);setLayout(0)}
    if (index==3) {condLayout(3,2);}
}; 

function articleClick(index,version){
    console.log('Article:'+index+','+version);
    messagesLoad(1,index);
};

function messageClick(index, article, eventtype) {
    console.log('Message:'+index+','+article+','+eventtype);
    setLayout(index % 3);
};

function setLayout(mode) {
    if (style!=-1) {
        Object.keys(styles[style]).forEach(key => {
           styles[style][key].forEach(value => {
           $("#"+key).removeClass(value); 
           });
        });
    }

    style=mode;

    Object.keys(styles[style]).forEach(key => {
       $("#"+key).css("display",((styles[style][key].length==0)?"none":"block"));
       styles[style][key].forEach(value => {
       $("#"+key).addClass(value); 
       });
    });
}

function condLayout(cond,mode){
    if (style==cond) {setLayout(mode);return true;}
}
