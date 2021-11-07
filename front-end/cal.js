var top1='c_tab'

function Table(Table) {
    var h=0;
    while (h<4 && h<Table.length ) {
        document.getElementById('img_'+h).innerHTML = '<img src="../img/'+Table[h].imgname+'" height="60px" width="60px">';
        document.getElementById('mech_0'+h).innerHTML = 'Name: '+Table[h].name;
        document.getElementById('mech_1'+h).innerHTML = 'Phone: '+Table[h].phone_no;
        if(Table[h].dist==undefined || Table[h].dist==null){
            document.getElementById('mech_2'+h).innerHTML = 'Distance: Enter location';
        }else{
            document.getElementById('mech_2'+h).innerHTML = 'Distance: '+Table[h].dist+'km';
        }
        document.getElementById('Book'+h).value = 'Book';
        document.getElementById('Book'+h).name = Table[h].id_no;
        var x = document.getElementById('rating'+h);
        rat(x, Table[h]);
        h++;
    }
}

function stat_up(x){
    document.getElementById('name').innerHTML = 'Name: '+x.name;
    document.getElementById('ph').innerHTML = 'Phone No: '+x.phone_no;
    loc(x.c_loc_lat, x.c_loc_lon);
    document.getElementById('statp').innerHTML = x.status;
}
