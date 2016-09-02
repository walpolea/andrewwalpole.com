SHELL=/bin/sh

DIST=_dist
CB=$(DIST)/clearbricks

default:
	@echo "make config or make dist"

config:
	mkdir -p ./$(CB)
	
	## Copy needed files and folders
	find ./ -mindepth 1 -maxdepth 1 -type d \
	-not -regex '.*svn.*' \
	-not -name '_dist' \
	-not -name 'debian' \
	-exec cp -r \{\} ./$(CB) \;
	
	## Copy _common.php and README files
	cp _common.php README ./$(CB)/
	
	## Remove .svn folders
	find ./$(CB)/ -type d -name '.svn' -print0 | xargs -0 rm -rf
	
	touch config-stamp

dist: config dist-tgz dist-zip

deb:
	cp ./README debian/README
	dpkg-buildpackage -rfakeroot

dist-tgz:
	[ -f config-stamp ]
	cd $(DIST) && tar cfz clearbricks-$$(grep CLEARBRICKS_VERSION clearbricks/common/_main.php | cut -d"'" -f4).tar.gz ./clearbricks

dist-zip:
	[ -f config-stamp ]
	cd $(DIST) && zip -r9 clearbricks-$$(grep CLEARBRICKS_VERSION clearbricks/common/_main.php | cut -d"'" -f4).zip ./clearbricks

clean:
	[ -f config-stamp ]
	rm -rf $(DIST)
	rm -f config-stamp build-stamp configure-stamp
