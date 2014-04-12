## Process this file with automake to produce Makefile.in
## Created by Anjuta

SUBDIRS = src 

calculatricedocdir = ${prefix}/doc/calculatrice
calculatricedoc_DATA = \
	COPYING\

EXTRA_DIST = $(calculatricedoc_DATA)


# Remove doc directory on uninstall
uninstall-local:
	-rm -r $(calculatricedocdir)
