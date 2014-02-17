import java.net.DatagramPacket;
import java.net.DatagramSocket;
import java.net.InetAddress;
import java.net.SocketException;


public class Synchronisateur {

	public boolean synchronisation(int port)
    {
		DatagramSocket clientSocket;
		String data="default value";
		boolean Continue=false;
		
	
		
		try
		{
		  clientSocket = new DatagramSocket();
		  
          byte[] receiveData = new byte[1024];
          byte[] sendData = new byte[1024];
          
          
           
             InetAddress IPAddress = InetAddress.getByName("localhost"); 
	          
	          //Partie ou on envois au programme cible
	          
	          String capitalizedSentence = "ReadyGPS";
	          
	          sendData = capitalizedSentence.getBytes();
	          
	          DatagramPacket sendPacket = new DatagramPacket(sendData, sendData.length, IPAddress, port);
	          
	          clientSocket.send(sendPacket);
	          
	          
	          
	          //Si packet re�u continu� l'execution
	          while(!Continue)
	          {
	        	System.out.println("Non - Re�u");
	            DatagramPacket receivePacket = new DatagramPacket(receiveData, receiveData.length);
	            
	            clientSocket.receive(receivePacket);
	            
	            System.out.println("Re�u");
	            
	            data=new String( receivePacket.getData());
                
	            
	            Continue=true;
	            
                
                System.out.println("Message Re�u GPS :"+new String(data));
                
            
                
	          }
	          
	          clientSocket.close();
	          
	          return true;
		}
		catch(Exception ex)
		{
			System.out.println(ex.getMessage());
			//serverSocket.close();
			return false;
		}
    } 
	
}
