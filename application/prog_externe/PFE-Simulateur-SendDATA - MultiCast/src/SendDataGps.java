import java.net.DatagramPacket;
import java.net.DatagramSocket;
import java.net.InetAddress;
import java.net.MulticastSocket;


public class SendDataGps {
     //Adresse d'envoi fixe
	 //Port sur lesquelle envoyé les données + Nb donnée pour service
	////format data = Latitude Longitude Altitude
	 public static void main(String[] args)
	 {
		MulticastSocket  clientSocket;
		boolean Continue=false;
		int port_envoi=44001;
		float altitude;
		float longitude;
		float latitude;
		String frame="Echec";
		
		
	    if(args.length==3)//=>Rmc
	    {
	    	Continue=true;
	    	
	    	port_envoi = (Integer) ((args.length >1) ? Integer.parseInt(args[0]) : 44001);
	    	latitude = Float.valueOf(args[1].trim()).floatValue();
	    	longitude = Float.valueOf(args[2].trim()).floatValue();
	    	
	    	/*
	    	 *Donnée d'une trame RMC
	    	 * 225446 = Heure du Fix 22:54:46 UTC
			A = Alerte du logigiel de navigation ( A = OK, V = warning (alerte)
			4916.45,N = Latitude 49°16.45' North
			12311.12,W = Longitude 123°11.12' West
			000.5 = vitesse sol, Knots
			054.7 = cap (vrai)
			191194 = Date du fix 19 Novembre 1994
			020.3,E = Déclinaison Magnetique 20.3 deg Est
			*68 = checksum obligatoire
			Non représentés CR et LF
	    	 */
	    	frame="<nmea_rmc> $GPRMC,"+"123519"+",A,"+latitude+",N,"+longitude+",E,"+"022.4,084.4,230394,003.1,"+"W*6A</nmea_rmc>";
	    
	    }
	    else if(args.length==4)//=>GGA
	    {
	    	Continue=true;
	    	port_envoi = (Integer) ((args.length >1) ? Integer.parseInt(args[0]) : 44002);
	    	latitude = Float.valueOf(args[1].trim()).floatValue();
	    	longitude = Float.valueOf(args[2].trim()).floatValue();
	    	altitude = Float.valueOf(args[3].trim()).floatValue();
	    	/*
	    	 * 
	    	 * 123519 = Acquisition du FIX à 12:35:19 UTC
			4807.038,N = Latitude 48°07.038' N
			01131.324,E = Longitude 11°31.324' E
			1 = Fix qualification : (0 = non valide, 1 = Fix GPS, 2 = Fix DGPS)
			08 = Nombre de satellites en pousuite.
			0.9 = DOP (Horizontal dilution of position) Dilution horizontale.
			545.4,M = Altitude, en Metres, au dessus du MSL (mean see level) niveau moyen des Océans.
			46.9,M = Correction de la hauteur de la géoïde en Metres par raport à l'ellipsoîde WGS84 (MSL).
			(Champ vide) = nombre de secondes écoulées depuis la dernière mise à jour DGPS.
			(Champ vide) = Identification de la station DGPS.
			*42 = Checksum
			Non représentés CR et LF.
	    	 */
	    	frame="<nmea_gga> $GPGGA,123519,"+latitude+",N,"+longitude+",E,1,08,0.9,"+altitude+",M,46.9,M, , *42 </nmea_gga>";
		    
			
	    }
		 else
		 {
			 System.out.println("Erreur dans les arguments");
		 }
	    
	  if(Continue)
	  {
		  try
			{
			  clientSocket = new MulticastSocket();
			  
		      byte[] receiveData = new byte[1024];
		      byte[] sendData = new byte[1024];
		      
		      
		       
		      InetAddress IPAddress = InetAddress.getByName("239.255.42.21");
		      							
		      
		      
		      sendData = frame.getBytes();
		      
		      DatagramPacket sendPacket = new DatagramPacket(sendData, sendData.length,IPAddress, port_envoi);
		      System.out.println("envoi à l'adresse : "+IPAddress.getHostAddress()+" sur le port :"+port_envoi+" du message "+frame);
		      
		      for(int a = 0 ; a < 10 ; a++)//on envoit 10 fois la requête.
		      {
		      clientSocket.send(sendPacket);
		      }
		      
			}catch(Exception ex)
			{
				System.out.println(ex);
			}
	  }
	 }
	  
}
