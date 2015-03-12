#include <Ethernet.h>
#include <SPI.h>
 
byte mac[]         = { 0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED }; // Mac Address Default
byte ip[]          = { 192, 168, 1, 117 }; // Ip untuk Ethernet shield
byte dnsserver[]   = { 8,8,8,8 }; // DNS Server untuk Ethernet shield
byte gateway[]     = { 192, 168, 1, 1 }; // Gateway untuk Ethernet shield
byte subnet[]      = { 255, 255, 255, 0 }; // Subnet untuk Ethernet shield

String data;
int a;
 
EthernetClient client;
 
void setup(void){
  Ethernet.begin(mac, ip, dnsserver, gateway, subnet);
  Serial.begin(9600);
}
 
 
void loop(void) {
  a = 0;
  a = analogRead(A5);
  a = (5.0*a*100.0)/1024.0;
  Serial.print(a);
  Serial.print('\n'); 
  if (client.connect("kiosline.com", 80)) {
    Serial.println("-> Connected");
    //masukkan ke database via php post
    client.print( "GET /suhu/addtemp.php?");
    client.print("temp=");
    client.print(a);
    client.println( " HTTP/1.1");
    client.print( "Host: " );
    client.println("kiosline.com");
    client.println( "Connection: close");
    client.println();
    client.println();
    client.stop();
    Serial.println("-> Close");
  }
  else {
    Serial.println("--> Gagal Koneksi");
  }
  delay(5000);
}
