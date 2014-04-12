import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.lang.management.ManagementFactory;

import structure_originale.StructureOriginale;
import table_hachage.TableDeHachage;
import arbre_binaire.ArbreBinaire;
import avl.AVL;
import corpus.CorpusInterface;

public class TestComplet {
	private static int NOMBRE_DE_TEST = 2;
	private static String NOM_FICHIER = "fichier.txt";

	private static double moyenne(long[] t, int deb, int fin) {
		if (deb >= 0 && fin <= t.length) {
			long somme = 0;
			for (int i = deb; i < fin; i++)
				somme += t[i];

			return Math.round(somme / (double) (fin - deb));
		} else
			return -1;
	}

	private static long INTERVAL_MESURE = 4000000;
	private static final long NOMBRE_DE_LIGNE = 226494091;

	private static String moyenneInterval(long[][] t, int deb, int fin) {
		if (deb >= 0 && fin <= t.length) {
			StringBuffer res = new StringBuffer((int) (NOMBRE_DE_LIGNE / INTERVAL_MESURE) * 10);
			for (int i = 1; i < (int) (NOMBRE_DE_LIGNE / INTERVAL_MESURE) + 1; i++) {
				long somme = 0;
				for (int j = deb; j < fin; j++)
					somme += t[j][i] - t[j][0];
				res.append("=" + Math.round(somme / (double) (fin - deb)) + ";");
			}

			return res.toString();
		} else
			return "Indices de tableau de mesure invalides";
	}

	public static void main(String[] args) {
		String mots = "";
		int k;
		try {
			String line;
			BufferedReader br = new BufferedReader(new FileReader(new File(NOM_FICHIER)));
			StringBuffer fichier = new StringBuffer(1300000000);
			fichier.append(" ");
			while ((line = br.readLine()) != null)
				fichier.append(line + ' ');
			br.close();
			mots = fichier.toString();
			fichier = null;
		} catch (FileNotFoundException e2) {
			e2.printStackTrace();
		} catch (IOException e2) {
			e2.printStackTrace();
		}
		System.gc();

		try {
			if (args.length == 1)
				try {
					NOMBRE_DE_TEST = Integer.parseInt(args[0]);
				} catch (NumberFormatException e) {
					NOM_FICHIER = args[0];
				}
			else if (args.length == 2)
				try {
					NOMBRE_DE_TEST = Integer.parseInt(args[0]);
				} catch (NumberFormatException e) {
					NOM_FICHIER = args[0];
					try {
						NOMBRE_DE_TEST = Integer.parseInt(args[1]);
					} catch (NumberFormatException e1) {
						System.out.println(args[1] + " n'est pas un nombre");
						System.out.println("Usage : java Test [nom fichier] [nombre de tests]");
					}
				}
			System.out.println("Initialisation des variables");
			CorpusInterface structure = null;
			long time_debut;
			long mem_debut;
			long cpu_debut;
			long[] time = new long[NOMBRE_DE_TEST * 4];
			long[] mem = new long[NOMBRE_DE_TEST * 4];
			long[] cpu = new long[NOMBRE_DE_TEST * 4];

			System.out.println("Lancement des mesures...");
			for (int i = 0; i < NOMBRE_DE_TEST * 4; i++) {
				if (i % NOMBRE_DE_TEST == 0)
					switch ((i / NOMBRE_DE_TEST) + 1) {
					case 1:
						System.out.println("AVL");
						break;
					case 2:
						System.out.println("\nSTRUCTURE ORIGINALE");
						break;
					case 3:
						System.out.println("\nTABLE DE HACHAGE");
						break;
					case 4:
						System.out.println("\nARBRES BINAIRES");
						break;
					}
				System.out.print("Mesure " + (i % NOMBRE_DE_TEST + 1) + "/" + NOMBRE_DE_TEST + "...");
				// Initialisation de la structure
				if (i < NOMBRE_DE_TEST * 1)
					structure = new AVL();
				else if (i < NOMBRE_DE_TEST * 2)
					structure = new StructureOriginale();
				else if (i < NOMBRE_DE_TEST * 3)
					structure = new TableDeHachage();
				else
					structure = new ArbreBinaire();

				// On lance le GarbageCollector histoire qu'il vienne pas pourrir
				// les mesures
				Runtime.getRuntime().gc();

				// Initialisation des variables de mesures
				time_debut = System.nanoTime();
				mem_debut = Runtime.getRuntime().maxMemory() - Runtime.getRuntime().freeMemory();
				cpu_debut = ManagementFactory.getThreadMXBean().getCurrentThreadCpuTime();

				k = 0;
				while (k < 1250218278)
					structure.ajouter(mots.substring(k++ + 1, (k = mots.indexOf(' ', k + 1))));

				// Enregistrement des mesures
				time[i] = System.nanoTime() - time_debut;
				System.gc();
				mem[i] = Runtime.getRuntime().maxMemory() - Runtime.getRuntime().freeMemory() - mem_debut;
				cpu[i] = ManagementFactory.getThreadMXBean().getCurrentThreadCpuTime() - cpu_debut;

				System.out.println("\tOK");
			}
			System.out.println("\nCalcul des résultats...\n");

			// Affichage des résultats
			BufferedWriter bw = new BufferedWriter(new FileWriter(new File("Test.csv")));
			for (int i = 0; i < 5; i++) {
				if (i != 0) {
					switch (i) {
					case 1:
						System.out.println("AVL");
						bw.write("AVL\n");
						break;
					case 2:
						System.out.println("\nSTRUCTURE ORIGINALE");
						bw.write("\nSTRUCTURE ORIGINALE\n");
						break;
					case 3:
						System.out.println("\nTABLE DE HACHAGE");
						bw.write("\nTABLE DE HACHAGE\n");
						break;
					case 4:
						System.out.println("\nARBRE BINAIRE");
						bw.write("\nARBRE BINAIRE\n");
						break;
					}
					System.out.println("\tdurée   : " + (moyenne(time, NOMBRE_DE_TEST * (i - 1), NOMBRE_DE_TEST * i))
							/ 1000000000 + "s");
					System.out.println("\tmémoire : " + (moyenne(mem, NOMBRE_DE_TEST * (i - 1), NOMBRE_DE_TEST * i))
							/ 1000000 + "Mo");
					System.out.println("\tcpu : " + (moyenne(cpu, NOMBRE_DE_TEST * (i - 1), NOMBRE_DE_TEST * i)));
					bw.write("durée;=" + moyenne(time, NOMBRE_DE_TEST * (i - 1), NOMBRE_DE_TEST * i) + "\n");
					bw.write("mémoire;=" + moyenne(mem, NOMBRE_DE_TEST * (i - 1), NOMBRE_DE_TEST * i) + "\n");
					bw.write("cpu;=" + moyenne(cpu, NOMBRE_DE_TEST * (i - 1), NOMBRE_DE_TEST * i) + "\n");

				}
			}
			bw.close();
		} catch (FileNotFoundException e) {
			System.out.println("Le fichier n'a pas été trouvé");
			System.out.println("Usage : java Test [nom fichier] [nombre de tests]");
		} catch (IOException e) {
			System.out.println("Erreur d'entrée/sortie");
			e.printStackTrace();
		}
		// Mesure d'interval
		try {
			System.out.print("Lecture des arguments...\t");
			if (args.length == 1)
				try {
					NOMBRE_DE_TEST = Integer.parseInt(args[0]);
				} catch (NumberFormatException e) {
					NOM_FICHIER = args[0];
				}
			else if (args.length == 2)
				try {
					NOMBRE_DE_TEST = Integer.parseInt(args[0]);
				} catch (NumberFormatException e) {
					NOM_FICHIER = args[0];
					try {
						NOMBRE_DE_TEST = Integer.parseInt(args[1]);
					} catch (NumberFormatException e1) {
						System.out.println(args[1] + " n'est pas un nombre");
						System.out.println("Usage : java Test [nom fichier] [nombre de tests]");
					}
				}
			System.out.println("OK");

			System.out.print("Initialisation des variables...\t");
			CorpusInterface structure = null;
			long[][] time = new long[NOMBRE_DE_TEST * 4][];
			long[][] mem = new long[NOMBRE_DE_TEST * 4][];
			long[][] cpu = new long[NOMBRE_DE_TEST * 4][];
			long[] time_interval;
			long[] mem_interval;
			long[] cpu_interval;
			long n;
			System.out.println("OK");

			System.out.println("Lancement des mesures...\tOK");
			for (int i = 0; i < NOMBRE_DE_TEST * 4; i++) {
				if (i % NOMBRE_DE_TEST == 0)
					switch ((i / NOMBRE_DE_TEST) + 1) {
					case 1:
						System.out.println("AVL");
						break;
					case 2:
						System.out.println("\nSTRUCTURE ORIGINALE");
						break;
					case 3:
						System.out.println("\nTABLE DE HACHAGE");
						break;
					case 4:
						System.out.println("\nARBRES BINAIRES");
						break;
					}
				// Initialisation de la structure
				if (i < NOMBRE_DE_TEST * 1)
					structure = new AVL();
				else if (i < NOMBRE_DE_TEST * 2)
					structure = new StructureOriginale();
				else if (i < NOMBRE_DE_TEST * 3)
					structure = new TableDeHachage();
				else
					structure = new ArbreBinaire();

				// Initialisation des variables de mesure
				time_interval = new long[(int) (NOMBRE_DE_LIGNE / INTERVAL_MESURE) + 1];
				mem_interval = new long[(int) (NOMBRE_DE_LIGNE / INTERVAL_MESURE) + 1];
				cpu_interval = new long[(int) (NOMBRE_DE_LIGNE / INTERVAL_MESURE) + 1];
				n = 0;

				// On lance le GarbageCollector histoire qu'il vienne pas pourrir
				// les mesures
				Runtime.getRuntime().gc();
				System.out.print("Mesure " + (i % NOMBRE_DE_TEST + 1) + "/" + NOMBRE_DE_TEST + "...");

				k = 0;
				while (k < 1250218278) {
					if (n++ % INTERVAL_MESURE == 0) {
						System.gc();
						time_interval[(int) (n / INTERVAL_MESURE)] = System.nanoTime();
						mem_interval[(int) (n / INTERVAL_MESURE)] = Runtime.getRuntime().maxMemory()
								- Runtime.getRuntime().freeMemory();
						cpu_interval[(int) (n / INTERVAL_MESURE)] = ManagementFactory.getThreadMXBean()
								.getCurrentThreadCpuTime();
					}
					structure.ajouter(mots.substring(k++ + 1, (k = mots.indexOf(' ', k + 1))));
				}
				time_interval[(int) (NOMBRE_DE_LIGNE / INTERVAL_MESURE)] = System.nanoTime();
				System.gc();
				mem_interval[(int) (NOMBRE_DE_LIGNE / INTERVAL_MESURE)] = Runtime.getRuntime().maxMemory()
						- Runtime.getRuntime().freeMemory();
				cpu_interval[(int) (n / INTERVAL_MESURE)] = ManagementFactory.getThreadMXBean().getCurrentThreadCpuTime();

				// Enregistrement des mesures
				time[i] = time_interval;
				mem[i] = mem_interval;
				cpu[i] = cpu_interval;

				System.out.println("\tOK");
			}
			System.out.println("\nCalcul des résultats...\n");

			// Affichage des résultats
			BufferedWriter bw = new BufferedWriter(new FileWriter(new File("TestInterval.csv")));
			for (int i = 0; i < 5; i++) {
				if (i != 0) {
					switch (i) {
					case 1:
						System.out.println("AVL");
						bw.write("AVL\n");
						break;
					case 2:
						System.out.println("\nSTRUCTURE ORIGINALE");
						bw.write("\nSTRUCTURE ORIGINALE\n");
						break;
					case 3:
						System.out.println("\nTABLE DE HACHAGE");
						bw.write("\nTABLE DE HACHAGE\n");
						break;
					case 4:
						System.out.println("\nARBRE BINAIRE");
						bw.write("\nARBRE BINAIRE\n");
						break;
					}
					System.out.println("\tdurée   : " + moyenneInterval(time, NOMBRE_DE_TEST * (i - 1), NOMBRE_DE_TEST * i));
					System.out.println("\tmémoire : " + moyenneInterval(mem, NOMBRE_DE_TEST * (i - 1), NOMBRE_DE_TEST * i));
					System.out.println("\tcpu : " + moyenneInterval(cpu, NOMBRE_DE_TEST * (i - 1), NOMBRE_DE_TEST * i));
					bw.write("durée;0;" + moyenneInterval(time, NOMBRE_DE_TEST * (i - 1), NOMBRE_DE_TEST * i) + "\n");
					bw.write("mémoire;0;" + moyenneInterval(mem, NOMBRE_DE_TEST * (i - 1), NOMBRE_DE_TEST * i) + "\n");
					bw.write("cpu;0;" + moyenneInterval(cpu, NOMBRE_DE_TEST * (i - 1), NOMBRE_DE_TEST * i) + "\n");
				}
			}
			bw.close();
		} catch (FileNotFoundException e) {
			System.out.println("Le fichier n'a pas été trouvé");
			System.out.println("Usage : java TestInterval [nom fichier] [nombre de tests]");
		} catch (IOException e) {
			System.out.println("Erreur d'entrée/sortie");
			e.printStackTrace();
		}
	}
}
