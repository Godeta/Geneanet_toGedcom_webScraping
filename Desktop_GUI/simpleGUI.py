# création d'une fenêtre et ajout d'un texte, quelques widgets basics : https://tkdocs.com/tutorial/widgets.html
import tkinter as tk
import os
url = ""

def launchPHP(url):
    """Fonction permettant de lancer le fichier test.php en ligne de commande (nécessite d'avoir php dans le path) """
    os.system('cd webScraping && php test.php '+url)

def createWindow():
    """Fonction principale contenant la création de la fenêtre et ses intéractions """
    window = tk.Tk()
    greeting = tk.Label(text="Bienvenu, entrez l'url d'un profil pour lequel vous soihaitez récupérer les données.",
        foreground="blue"  # Set the text color to white
        )
    greeting.pack()
    label = tk.Label(text="URL")
    entry = tk.Entry(fg="black", bg="white", width=50)
    label.pack()
    entry.pack()
    button = tk.Button(
        text="Executer le scraping",
        width=25,
        height=5,
        bg="grey",
        fg="yellow",
        command = lambda: launchPHP(entry.get())
    )
    button.pack()
    window.mainloop()

#code principal executé lors de l'appel du fichier python
createWindow()