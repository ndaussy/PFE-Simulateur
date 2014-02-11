package receivesocket;
import com.apple.dnssd.*;

public class TestBrowse implements BrowseListener
{
       public String TabBrowser[];
	
	// Display error message on failure
	  public void operationFailed(DNSSDService service, int errorCode)
	    {
	    System.out.println("Browse failed " + errorCode);
	    System.exit(-1);
	    }

	  // Display services we discover
	  public void serviceFound(DNSSDService browser, int flags, int ifIndex,
	            String name, String regType, String domain)
	    {
            for(int a = 0 ; a < 50 ; a++)
            {
            if(TabBrowser[a]==null)
            {
            TabBrowser[a]="Service n°"+a+" : \nAdd flags:" + flags + ", \nifIndex:" + ifIndex +",\n Name:" + name + ", \nType:" + regType + ", \nDomain:" + domain;
            break;
            }
            
            }
            System.out.println("Add flags:" + flags + ", ifIndex:" + ifIndex +
	      ", Name:" + name + ", Type:" + regType + ", Domain:" + domain);
	    }

	  // Print a line when services go away
	  public void serviceLost(DNSSDService browser, int flags, int ifIndex,
	            String name, String regType, String domain)
	    {
	    System.out.println("Rmv flags:" + flags + ", ifIndex:" + ifIndex +
	      ", Name:" + name + ", Type:" + regType + ", Domain:" + domain);
	    }
	
	  public TestBrowse(String name  ) throws DNSSDException, InterruptedException
	    {
                if(name==null)
                {
                    name = "ebsf_socket._udp";
                }
            System.out.println(name);   
            TabBrowser=new String[50];
	    System.out.println("TestBrowse Starting");
	    DNSSDService b = DNSSD.browse("_ebsf_socket._udp", this);
	    System.out.println("TestBrowse Running");
                Thread.sleep(50);
	    System.out.println("TestBrowse Stopping");
	    b.stop(  );
	    }

	  
  	
	
	
}