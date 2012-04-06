import java.io.*;
import java.net.*;
class download
{
public static void saveUrl(String filename, String urlString) throws MalformedURLException, IOException
    {
        BufferedInputStream in = null;
        FileOutputStream fout = null;
        try
        {
                in = new BufferedInputStream(new URL(urlString).openStream());
                fout = new FileOutputStream(filename);`

                byte data[] = new byte[1024];
                int count;
                while ((count = in.read(data, 0, 1024)) != -1)
                {
                        fout.write(data, 0, count);
                }
        }
        finally
        {
                if (in != null)
                        in.close();
                if (fout != null)
                        fout.close();
        }
    }

public static void main(String args[])
{
try
{
saveUrl(args[1],args[0]);
}
catch(MalformedURLException e)
{
System.out.println("wtf");
}
catch(IOException e)
{
System.out.println("wtf");
}
}
}
