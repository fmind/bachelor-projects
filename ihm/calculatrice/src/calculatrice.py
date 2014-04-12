#!/usr/bin/python
# -*- coding: utf-8 -*-
#
# calculatrice.py
# Copyright (C) Médéric Hurier 2012 <mederic.hurie@etudiant.univ-nancy2.fr>
# 
# calculatrice is free software: you can redistribute it and/or modify it
# under the terms of the GNU General Public License as published by the
# Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.
# 
# calculatrice is distributed in the hope that it will be useful, but
# WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
# See the GNU General Public License for more details.
# 
# You should have received a copy of the GNU General Public License along
# with this program.  If not, see <http://www.gnu.org/licenses/>.


from gi.repository import Gtk, Gdk, Gio
import os, sys


UI_FILE 	= "src/calculatrice.ui"
CSS_FILE	= "ressources/styles.css"


class GUI:
	# Operations
	ERROR	= -1
	NO		= 0
	PLUS 	= 1
	MINUS	= 2
	TIMES	= 3
	DIVIDES	= 4
	
	def __init__(self):
		# Init GUI
		self.builder = Gtk.Builder()
		self.builder.add_from_file(UI_FILE)
		self.builder.connect_signals(self)
		self.screen = Gdk.Screen.get_default()
		self.window = self.builder.get_object('window')
		self.result = self.builder.get_object('result')

		# CSS
		self.css = Gtk.CssProvider()
		# choose theme
		if len(sys.argv) == 2:
			theme = sys.argv[1]
			print theme
		else:
			self.css.load_from_file(Gio.File.new_for_path(CSS_FILE))
		Gtk.StyleContext.add_provider_for_screen(self.screen, self.css, Gtk.STYLE_PROVIDER_PRIORITY_APPLICATION)
		self.__setup_css_names()
		
		# Show the main window
		self.reset()
		self.window.show_all()

	def __setup_css_names(self):
		""" Convert Glade name to widget name (Strange behaviour ...) """
		objects = ('window', 'button_minus', 'button_plus', 'button_times', 'button_divides', 'button_equals', 'button_welcome', 'button_cancel')
		for obj_name in objects:
			self.builder.get_object(obj_name).set_name(obj_name)

	def destroy(window, self):
		""" Quit the application """
		Gtk.main_quit()

	def reset(self):
		""" Reset all operations """
		self.buffer = None
		self.operation = GUI.NO
		self.saved_result = ""
		self.is_final_result = False
		self.result.set_text("")
		self.switch_background(self.operation)
		
	def compute(self, operation, number1, number2):
		""" Compute two number """
		if self.operation == GUI.PLUS:
			return  number1 + number2
		elif self.operation == GUI.MINUS:
			return number1 - number2
		elif self.operation == GUI.TIMES:
			return number1 * number2
		elif self.operation == GUI.DIVIDES:
			if number2 == 0:
				raise ArithmeticError("Erreur: Division par zéro")
			return number1 / number2
		elif self.operation == GUI.ERROR:
			raise ArithmeticError("Erreur: Opération invalide")
		else:
			return number1

	def has_operation_saved(self):
		""" Test if an intermediate operation is already saved """
		return not (self.operation == GUI.NO and self.buffer == None)

	def save_operation(self, operation, number):
		""" Save an operation """
		# Compute intermediate result
		if self.has_operation_saved():
			try:
				number = self.compute(self.operation, self.buffer, number)
			except ArithmeticError, e:
				self.display_error(e.message)
				return
			
		# Save new operation
		self.buffer = number
		self.operation = operation
		self.result.set_text("")
		self.switch_background(self.operation)
		if self.is_final_result:
			self.is_final_result = False

	def push_in_entry(self, char):
		""" Push a character at the end of the result entry """
		entry = self.result.get_text()

		# Clean previous result
		if self.is_final_result and len(entry):
			entry = ""
			self.is_final_result = False

		# Limit to 15 characters
		if len(entry) >=  15:
			return
		# Pas de zéro à gauche des nombres
		elif char == '0' and (not len(entry) or (len(entry) == 1 and entry[0] == '-')):
			return
		else:
			self.result.set_text(entry+char)	# String concatenation

	def display_result(self, total):
		""" Display the final result """
		self.reset()

		if len(total) <= 15:
			self.result.set_text(total)
			self.is_final_result = True
			self.switch_background(GUI.NO)
		else:	# Case more than infinite => Error
			self.display_error("Erreur: " + unichr(8734) + " ..." + total[-10:])

	def display_error(self, message):
		""" Display an error to the user in the result entry """
		self.operation = GUI.ERROR
		self.result.set_text(message)
		self.switch_background(self.operation)
				
	def switch_background(self, operation):
		""" Switch the main window background """
		background = self.window.get_style_context()

		# Remove previous classes
		for class_name in background.list_classes():
			background.remove_class(class_name)

		# Add a new class
		if operation == GUI.PLUS:
			background.add_class('plus')
		elif operation == GUI.MINUS:
			background.add_class('minus')
		elif operation == GUI.TIMES:
			background.add_class('times')
		elif operation == GUI.DIVIDES:
			background.add_class('divides')
		elif operation == GUI.ERROR:
			background.add_class('compute_error')

		# Redraw
		background.reset_widgets(self.screen)
		
	def on_figure_clicked(self, widget):
		self.push_in_entry(widget.get_label())

	def on_plus_clicked(self, widget):
		try:
			number = int(self.result.get_text())
		except TypeError:
			pass
		except ValueError:
			pass
		else:
			self.save_operation(GUI.PLUS, number)

	def on_minus_clicked(self, widget):
		try:
			number = int(self.result.get_text())
		except TypeError:
			pass
		except ValueError:
			# Add a minus sign in the entry (if it s the first char)
			if self.result.get_text() == '':
				self.push_in_entry(widget.get_label())
		else:
			self.save_operation(GUI.MINUS, number)

	def on_times_clicked(self, widget):
		try:
			number = int(self.result.get_text())
		except TypeError:
			pass
		except ValueError:
			pass
		else:
			self.save_operation(GUI.TIMES, number)

	def on_divides_clicked(self, widget):
		try:
			number = int(self.result.get_text())
		except TypeError:
			pass
		except ValueError:
			pass
		else:
			self.save_operation(GUI.DIVIDES, number)

	def on_equals_clicked(self, widget):
		try:
			number = int(self.result.get_text())
		except TypeError:
			pass
		except ValueError:
			pass
		else:
			if self.has_operation_saved():
				try:
					total = self.compute(self.operation, self.buffer, number)
				except ArithmeticError, e:
					self.display_error(e.message)
				else:
					self.display_result(str(total))

	def on_information_pressed(self, widget):
		import datetime
		now = datetime.datetime.now()

		# Save current number
		self.saved_result = self.result.get_text()

		text = ""
		# Display a nice welcome message
		#
		#if now.hour >= 6 and now.hour < 13:
		#	text = "Bonjour, il est "
		#elif now.hour >= 13 and now.hour < 18:
		#	text = "Bonne aprem, il est "
		#else:
		#	text = "Bonsoir, il est "
		text += "Il est "
		text += now.strftime("%H:%M")

		self.result.get_style_context().add_class('welcome')
		self.result.set_text(text)

	def on_information_released(self, widget):
		self.result.get_style_context().remove_class('welcome')
		self.result.set_text(self.saved_result)
		
	def on_cancel_clicked(self, widget):
		self.reset()

def main():
	app = GUI()
	Gtk.main()
		
if __name__ == "__main__":
    sys.exit(main())
