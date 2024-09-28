#!~/myvenv/bin python

from docx import Document

document = Document('test.docx')

for i, para in enumerate(document.paragraphs):
    with open(f"para-{i}.txt", 'w') as f:
        f.write(para.text)