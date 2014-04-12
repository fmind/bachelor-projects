## Process this file with automake to produce Makefile.in
## Created by Anjuta


uidir = $(datadir)/calculatrice/ui
ui_DATA = calculatrice.ui \
	src/styles.css


## The main script
bin_SCRIPTS = calculatrice.py

## Directory where .class files will be installed
calculatricedir = $(pythondir)/calculatrice


calculatrice_PYTHON = \
	calculatrice.py


EXTRA_DIST = $(ui_DATA)


# Remove ui directory on uninstall
uninstall-local:

	-rm -r $(uidir)

	-rm -r $(datadir)/calculatrice
