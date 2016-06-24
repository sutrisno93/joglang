var x = 1;
//cek dulu apakah data sudah masuk
function cek(){
    $.ajax({
        url: "c_notif.php", //ambil data dari db untuk notif
		data :"op=ambil",
        cache: false,
        success: function(msg){
            $("#notifikasi").html(msg);
        }
    });
    
	
	 $.ajax({
        url: "c_notif.php", //ambil data dari db untuk notif
		data :"op=stock",
        cache: false,
        success: function(msg){
            $("#stock").html(msg);
        }
    }); 
	
	$.ajax({
        url: "c_notif.php", //ambil data dari db untuk notif
		data :"op=order",
        cache: false,
        success: function(msg){
            $("#ordero").html(msg);
        }
    });
	
	$.ajax({
        url: "c_notif.php", //ambil data dari db untuk notif
		data :"op=notif",
        cache: false,
        success: function(msg){
            $("#notifo").html(msg);
        }
    });
	 
}



$(document).ready(function(){
    cek();
    $("#pesan").click(function(){
        $("#loading").show();
        if(x==1){
            $("#pesan").css("background-color","#605CA8");
            x = 0;
        }else{
            $("#pesan").css("background-color","#605CA8");
            x = 1;
        }
        $("#info").toggle();
        //ajax untuk menampilkan pesan yang belum terbaca
        $.ajax({
            url: "c_notif.php",
			data: "op=tampil",
            cache: false,
            success: function(msg){
                $("#loading").hide();
                $("#konten-info").html(msg);
            }
        });

    });
    $("#content").click(function(){
        $("#info").hide();
        $("#pesan").css("background-color","#605CA8");
        x = 1;
    });
	
	
	//order
	$("#order").click(function(){
        $("#loading").show();
        if(x==1){
            $("#order").css("background-color","#605CA8");
            x = 0;
        }else{
            $("#order").css("background-color","#605CA8");
            x = 1;
        }
        $("#tampilorder").toggle();
        //ajax untuk menampilkan pesan yang belum terbaca
        $.ajax({
            url: "c_notif.php",
			data: "op=ordert",
            cache: false,
            success: function(msg){
                $("#loading").hide();
                $("#konten-order").html(msg);
            }
        });

    });
    $("#content").click(function(){
        $("#info").hide();
        $("#order").css("background-color","#605CA8");
        x = 1;
    });
	
	
	//notif user
	$("#notif").click(function(){
        $("#loading").show();
        if(x==1){
            $("#notif").css("background-color","#605CA8");
            x = 0;
        }else{
            $("#notif").css("background-color","#605CA8");
            x = 1;
        }
        $("#tampilnotif").toggle();
        //ajax untuk menampilkan pesan yang belum terbaca
        $.ajax({
            url: "c_notif.php",
			data: "op=notift",
            cache: false,
            success: function(msg){
                $("#loading").hide();
                $("#konten-notif").html(msg);
            }
        });

    });
    $("#content").click(function(){
        $("#info").hide();
        $("#notif").css("background-color","#605CA8");
        x = 1;
    });
	
	
	
});

