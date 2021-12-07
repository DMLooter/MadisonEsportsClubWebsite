import csv

with open('board.csv', newline='') as file:
	reader = csv.reader(file, delimiter=',')
	with open('board.html', 'w') as output:
		rownum = 0;
		for row in reader:
			if rownum != 0:
				output.write(f'<tr>\n<td>{row[0]}</td>\n<td>{row[1]}</td>\n</tr>\n');
			rownum+=1

with open('games.csv', newline='') as file:
	reader = csv.reader(file, delimiter=',')
	with open('games.html', 'w') as output:
		rownum = 0;
		for row in reader:
			if rownum != 0:
				output.write(f'<tr>\n<td><a href="/game/{row[2]}">{row[0]}</a></td>\n<td>{row[1]}</td>\n</tr>\n');
			rownum+=1

