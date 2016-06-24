var kode;
var nama;

$(function(){
                    $("#kode").load("c_order.php","op=kode");
                    $("#databar").load("c_order.php","op=databarang");
                    //jika ada perubahan di kode barang
                    $("#kode").change(function(){
                        kode=$("#kode").val();
                        
                        //tampilkan status loading dan animasinya
                        $("#status").html("loading. . .");
                        $("#loading").show();
                        
                        //lakukan pengiriman data
                        $.ajax({
                            url:"c_order.php",
                            data:"op=ambildata&kode="+kode,
                            cache:false,
                            success:function(msg){
                                $("#koder").html(msg);
                                
                            $("#status").html("");
                            $("#loading").hide();
                            }
                        });
                    });
});