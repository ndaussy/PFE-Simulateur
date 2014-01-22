


import javax.swing.JFrame;

import com.apple.dnssd.*;



public class Register extends JFrame implements RegisterListener
{

	
	  // Do the registration
	  /**
	 * 
	 */
	private static final long serialVersionUID = 1L;




	public Register(String name , int port) throws DNSSDException, InterruptedException
	{
	    
	    Synchronisateur sy = new Synchronisateur();
	    
	    if(sy.synchronisation(4150))
	    {
	    
	    	 
	    System.out.println("Registration Starting");
	    System.out.println("Requested Name: " + name);
	    System.out.println("          Port: " + port);

	    DNSSDRegistration r = DNSSD.register(name, "_ebsf_socket._udp", port, (RegisterListener) this);
	    
	    Thread.sleep(60000);  // Wait thirty seconds, then exit
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
	      System.out.println("Usage: java TestRegister name");
	      System.exit(-1);
	      }
	    else
	      {
	      try
	        {
	        //Config
	        String name = (args.length > 0) ? args[0] : "TestRegisterJava";
	        int port = (Integer) ((args.length >1) ? args[1] : 5353);
	        
	        DNSSDService s;
	        Register rg = new Register(name, port);
	        
	        }
	      catch(Exception e)
	        {
	        e.printStackTrace(  );
	        System.exit(-1);
	        }
	      }
	    }
	  
	

	
		
	}
