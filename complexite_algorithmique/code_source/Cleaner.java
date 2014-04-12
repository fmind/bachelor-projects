import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;

public class Cleaner {
	public static void main(String[] args) {
		try {
			BufferedReader br = new BufferedReader(new FileReader(new File(args[0])));
			BufferedWriter bw = new BufferedWriter(new FileWriter(new File(args[1])));
			String line;
			while ((line = br.readLine()) != null)
				for (String s : line.replaceAll("\n", "").replaceAll("\t", " ").replaceAll("  ", " ").split(" "))
					if (s != "" && s!= "\n")
						bw.write(s + "\n");
			bw.close();
			br.close();
		} catch (FileNotFoundException e) {
			System.out.println("Fichier non trouvé !");
			System.out.println("Usage : java Cleaner \"chemin fichier entree\" \"chemin fichier sortie\"");
			System.out.println();
			e.printStackTrace();
		} catch (IOException e) {
			e.printStackTrace();
		}

	}
}
