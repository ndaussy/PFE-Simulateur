import java.net.DatagramPacket;
import java.net.DatagramSocket;
import java.net.InetAddress;




public class main {
	
	 public static void main(String args[]) throws Exception
     {
		   boolean SendEveryData=false;
		   boolean can = false;
		   boolean gps = false;
		   int cpt=0;
		   
		   InetAddress [] IPAddress = new InetAddress[2] ;
		   int [] portReceive = new int[2];
		   
		   DatagramSocket serverSocket = new DatagramSocket(4150);
          
		   byte[] receiveData = new byte[1024];
           byte[] sendData = new byte[1024];
           
           while(!SendEveryData)
              {
                 DatagramPacket receivePacket = new DatagramPacket(receiveData, receiveData.length);
                 
                 serverSocket.receive(receivePacket);
                 
                 String sentence = new String( receivePacket.getData());
                 
                 System.out.println("Message reçu "+sentence);
                 
                 //sentence="t";
                 IPAddress[cpt] = receivePacket.getAddress();
                 portReceive[cpt] = receivePacket.getPort();
                 cpt++;
                 
                 
                 /*if(sentence.equals("ReadyCAN"))
                 {
                	can=true;
                	System.out.println("CAN : " + sentence);
                	 
                 }
                 else if(sentence=="ReadyGPS")
                 {
                	 gps = true;
                	 System.out.println("GPS : " + sentence);
                 }
                 
                 if(can&&gps)
                 {
                	 SendEveryData=true;
                 }*/
                 if(cpt==2)
                 //if(SendEveryData)
                 {
	                 System.out.println("All programme synchronized");
	                 
	                 String capitalizedSentence = "Ready";
	                 sendData = capitalizedSentence.getBytes();
	                 
	                 for(int a = 0 ; a< IPAddress.length ;a++)
	                 {
	                 
	                 DatagramPacket sendPacket = new DatagramPacket(sendData, sendData.length, IPAddress[a], portReceive[a]);
	                 
	                 serverSocket.send(sendPacket);
	                 
	                 }
                 }
              }
           
           serverSocket.close();
     } 

}
