


import java.io.IOException;
import java.net.DatagramPacket;
import java.net.DatagramSocket;
import java.net.InetAddress;
import java.net.SocketException;

import javax.swing.JFrame;

import com.apple.dnssd.*;



public class Register extends JFrame implements RegisterListener
{

	
	  // Do the registration
	  /**
	 * 
	 */
	private static final long serialVersionUID = 1L;




	public Register(String name , int port, int port_message_fin) throws DNSSDException, InterruptedException, IOException
	{
	    
	    //Synchronisateur sy = new Synchronisateur();
	    
	    //if(sy.synchronisation(4150))
	    {
	    
	    String adresse = "239.255.42.21";
	    System.out.println("Registration Starting");
	    System.out.println("Requested Name: " + name);
	    System.out.println("          Port: " + port);

	    //DNSSDRegistration r = DNSSD.register(name, "_ebsf_socket._udp", port, (RegisterListener) this);

	    
	    TXTRecord txt = new TXTRecord();
	    
	    txt.set("adresse", adresse);
	    txt.set("port",Integer.toString(port));
	    
	    DNSSDRegistration r = DNSSD.register(
	    		0,//valeurs par default
	    		0, 
	    		name, 
	    		"_ebsf_socket._udp",
	    		null, 
	    		null,
	    		port,
	    		txt,
	    		(RegisterListener) this);
	   
	    //Enregistrement du service puis envoi des donnée via l'application SendDataGps
	    try {
	    	byte[] receiveData = new byte[1024];
	        byte[] sendData = new byte[1024];
	    	
	        InetAddress laddr = InetAddress.getByName("127.0.0.1");
	        
			DatagramSocket serverSocket =  new DatagramSocket(port_message_fin,laddr);
			
	        //DatagramSocket serverSocket =  new DatagramSocket(port_message_fin);
	        
			DatagramPacket receivePacket = new DatagramPacket(receiveData, receiveData.length);
            
            serverSocket.receive(receivePacket);
            
            serverSocket.close();
            } catch (SocketException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
	    
	 
	    System.out.println("Registration Stopping");
	    r.stop(  );
	    }
	  }
		
	
	 // Display error message on failure
	  public void operationFailed(DNSSDService service, int errorCode)
	    {
	    System.out.println("Registration failed " + errorCode);
	    }

	  // Display registered name on success
	  public void serviceRegistered(DNSSDRegistration registration, int flags,
	    String serviceName, String regType, String domain)
	    {
	    System.out.println("Registered Name  : " + serviceName);
	    System.out.println("           Type  : " + regType);
	    System.out.println("           Domain: " + domain);
	    }


	

	  public static void main(String[] args)
	  {
	    if (args.length > 1)
	    {
	      try
	        {
	        //Config
	        String name = (args.length > 0) ? args[0] : "gps";
	        int port = (Integer) ((args.length >1) ? Integer.parseInt(args[1]) : 44001);
	        int port_message_fin = (Integer) ((args.length >1) ? Integer.parseInt(args[2]) : 99000);
	        
	        Register rg = new Register(name, port,port_message_fin);
	        
	        }
	      catch(Exception e)
	        {
	        e.printStackTrace(  );
	        System.exit(-1);
	        }
	      }
		  else
		  {
			  System.out.println("Erreur Argument");
			  System.exit(-1);
		  }
		
	  }
}
