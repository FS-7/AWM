//                  INITIALIZATION

//Maps
var marker, myObj, C_Arr, myObjx, h, top1='c_tab';
var dist = new Array();
var body0 = document.getElementById('mech_list');

const platform = new H.service.Platform({ apikey: 'D_6Bq02OZ4b2BBwXAJYFlZ6yHIixKl0Q5ym9lUlNhxg' });
const defaultLayers = platform.createDefaultLayers();
const map = new H.Map(document.getElementById('map'),
    defaultLayers.vector.normal.map, {
    center: { lat: 15.3425, lng: 75.1475 },
    zoom: 11,
    pixelRatio: window.devicePixelRatio || 1
});

//UI controls
window.addEventListener('resize', () => map.getViewPort().resize());
const behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
const ui = H.ui.UI.createDefault(map, defaultLayers);

//Lower-right
function init() {
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
        myObj = JSON.parse(this.responseText);
        for(i=0; i<myObj.length; i++){
            addBubble(myObj[i], i);
        }
        mechlist();
    }
    xmlhttp.open("POST", "../back-end/maps.php");
    xmlhttp.send();
}

function init2() {
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {
        myObjx = JSON.parse(this.responseText);
        C_Arr= Object.create(myObjx);
        var Arr_loc = new Array();
        for (h = 0; h < myObjx.length; h++) {
            C_Arr[h].dist = parseInt(distance(C_Arr[h].c_loc_lat, C_Arr[h].c_loc_lon, C_Arr[h].gar_loc_lat, C_Arr[h].gar_loc_lng));//Arr_loc[0];
            C_Arr[h].loc = addx;//loc(C_Arr[h].c_loc_lat, C_Arr[h].c_loc_lon);
        }
        c_stat();
        cust_status(C_Arr);
    }
    xmlhttp.open("POST", "../back-end/cal.php");
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("func=stat");
}

init();
init2();

//mechanic markers
function addBubble(element, h) {
    var value = {lat: element.gar_loc_lat, lng: element.gar_loc_lng};
    if(element.imgname=='' || element.imgname==null){
        element.imgname='awm.jpg';
    }
    var html = '<div><img id="mechimg_'+h+'"></div>'+'<div><p id="info_'+h+'"></p></div>';
    var bubble = new Array();
    bubble[h] = new H.ui.InfoBubble(value,{
        content: html
    });
    ui.addBubble(bubble[h]);
    var info = document.getElementById('info_'+h);
    var mechimg = document.getElementById('mechimg_'+h);
    info.innerHTML = 'Name: '+element.name+'<br>Phone: '+element.phone_no;
    mechimg.setAttribute('src', '../img/'+element.imgname);
    mechimg.setAttribute('style', 'height: 50px;');
    info.setAttribute('style', 'font-size: 12px;');  
}


//mechanic list 
function mechlist(){
    for(h=0; h<4 && h < myObj.length; h++){
        tr01 = document.createElement("tr");
        td01 = document.createElement("td");
            tbl01 = document.createElement("table");
                tblBody01 = document.createElement("tbody");
                    row01 = document.createElement("tr");
                        cell01 = document.createElement("td");
                            cell01.setAttribute('id','img_'+h);
                        row01.appendChild(cell01);
                        cell11 = document.createElement("td");
                            tbl11 = document.createElement("table");
                                tblBody11 = document.createElement("tbody");
                                    for (let index = 0; index < 3; index++) {
                                        row11 = document.createElement("tr");
                                            cell12 = document.createElement("td");
                                                cellText0 = document.createElement("p");
                                                cellText0.setAttribute('id','mech_'+index+h);
                                                cellText0.setAttribute('style','margin: 0px;');
                                                cell12.appendChild(cellText0);
                                            row11.appendChild(cell12);
                                        tblBody11.appendChild(row11);    
                                    }
                                tbl11.appendChild(tblBody11);
                            cell11.appendChild(tbl11); 
                        row01.appendChild(cell11);  
                        cellRating0 = document.createElement("td");
                            button0 = document.createElement("input");
                            button0.setAttribute('type', 'submit');
                            button0.setAttribute('class', 'Book');
                            button0.setAttribute('onclick', 'book(this)');
                            button0.setAttribute('id', 'Book'+h);
                            cellRating0.appendChild(button0);
                            cellTextRating0 = document.createElement("p");
                            cellTextRating0.setAttribute('class','rating');
                            cellTextRating0.setAttribute('id','rating'+h);
                            cellTextRating0.setAttribute('style','margin: 0px;');
                            cellRating0.appendChild(cellTextRating0);                
                        row01.appendChild(cellRating0);        
                    tblBody01.appendChild(row01);
                tbl01.appendChild(tblBody01);
            td01.appendChild(tbl01);
        tr01.appendChild(td01);
        body0.appendChild(tr01);
        tbl01.setAttribute('class','mech_list1');
        tbl01.setAttribute('id',h);
    };
    Table(myObj);
}


//          UPPER-RIGHT TABLE, STATUS
function m_stat() {
    m_body = document.getElementById('stat');
    strong = document.createElement('strong');
        table = document.createElement('table');
            row = document.createElement('tr');
                cell = document.createElement('td');
                    tbl = document.createElement('table');
                        rw1 = document.createElement('tr');
                            cl1 = document.createElement('td');
                                cl1.setAttribute('id', 'cname');
                            rw1.appendChild(cl1);
                        tbl.appendChild(rw1);
                        rw2 = document.createElement('tr');
                            cl2 = document.createElement('td');
                                cl2.setAttribute('id', 'cphone');
                            rw2.appendChild(cl2);
                        tbl.appendChild(rw2);
                        rw3 = document.createElement('tr');
                            cl3 = document.createElement('td');
                                cl3.setAttribute('id', 'Loc_M');
                            rw3.appendChild(cl3);
                        tbl.appendChild(rw3);
                    cell.appendChild(tbl);
                row.appendChild(cell);
                td2 = document.createElement('td');
                        stat = document.createElement('p');
                            stat.setAttribute('id', 'statp');
                        td2.appendChild(stat);
                        button1 = document.createElement('button');
                            button1.setAttribute('id', 'Accepted');
                            button1.setAttribute('class', 'Book');
                        td2.appendChild(button1);
                        button2 = document.createElement('button');
                            button2.setAttribute('id', 'Rejected');
                            button2.setAttribute('class', 'Book');
                        td2.appendChild(button2);
                    td2.setAttribute('id','stat_right')
                    row.appendChild(td2);
                row.appendChild(td2);  
            table.appendChild(row);
        table.setAttribute('class', 'notify');
        table.setAttribute('id', 'm_tab');
        strong.appendChild(table);    
    m_body.appendChild(strong);
    button1.setAttribute('onclick', 'task(this.id);');
    button2.setAttribute('onclick', 'task(this.id);');
    document.getElementById('Accepted').innerHTML = 'ACCEPT';
    document.getElementById('Rejected').innerHTML = 'REJECT';
}

function c_stat() {
    c_body = document.getElementById('stat');
        strong = document.createElement('strong');
            table = document.createElement('table');
                row = document.createElement('tr');
                    cell = document.createElement('td');
                        tbl = document.createElement('table');
                            rw1 = document.createElement('tr');
                                cl1 = document.createElement('td');
                                    cl1.setAttribute('id', 'mech_name');
                                rw1.appendChild(cl1);
                            tbl.appendChild(rw1);
                            rw2 = document.createElement('tr');
                                cl2 = document.createElement('td');
                                    cl2.setAttribute('id', 'Dist_C');
                                rw2.appendChild(cl2);
                            tbl.appendChild(rw2);
                            rw3 = document.createElement('tr');
                                cl3 = document.createElement('td');
                                    cl3.setAttribute('id', 'Loc_C');
                                rw3.appendChild(cl3);
                            tbl.appendChild(rw3);
                        cell.setAttribute('id', 'det_left');
                        cell.appendChild(tbl);
                    row.appendChild(cell);
                    td2 = document.createElement('td');
                        stat = document.createElement('p');
                            stat.setAttribute('id', 'statp');
                        td2.appendChild(stat);
                        br = document.createElement('br');
                        td2.appendChild(br);
                        button = document.createElement('button');
                            button.setAttribute('id', 'Cancelled');
                            button.setAttribute('class', 'Book');
                        td2.appendChild(button);
                    td2.setAttribute('id','stat_right')
                    row.appendChild(td2);
                table.appendChild(row);
            table.setAttribute('class', 'notify');
            table.setAttribute('id', 'c_tab');
            strong.appendChild(table); 
        c_body.appendChild(strong);
    button.setAttribute('onclick', 'task(this.id);');
    document.getElementById('Cancelled').innerHTML = 'CANCEL';
    cust_status(C_Arr);
}