package receivesocket;
import com.apple.dnssd.*;

public class resolveListener implements ResolveListener
{       
        public String Key[];
    
	// Display error message on failure
	  public void operationFailed(DNSSDService service, int errorCode)
	    {
	    System.out.println("Resolve failed " + errorCode);
	    System.exit(-1);
	    }

	  // Display information when service is resolved
	  public void serviceResolved(DNSSDService resolver, int flags, int ifIndex,
	    String fullName, String hostName, int port, TXTRecord txtRecord)
	    {
	    System.out.println("Service Resolved: " + hostName + ":" + port);
	    System.out.println("Flags: " + flags +
	      ", ifIndex: " + ifIndex + ", FQDN: " + fullName);

	    for (int i = 0; i < txtRecord.size(  ); i++)
	      {
	      String key = txtRecord.getKey(i);
	      String value = txtRecord.getValueAsString(i);
	      if (key.length(  ) > 0){
                    Key[i]=value;
                    System.out.println("\t" + key + "=" + value);
              }
	      }
	    }

	  public resolveListener(String name,String service, String domain)
	    throws DNSSDException, InterruptedException
	    {
            Key = new String[2];
	    System.out.println("TestResolve Starting");
            
	    DNSSDService r = DNSSD.resolve(0, DNSSD.ALL_INTERFACES,
	      name, service, domain, this);
	    System.out.println("TestResolve Running");
	    Thread.sleep(500);
	    System.out.println("TestResolve Stopping");
	    r.stop(  );
	    }
	
	
	
}
