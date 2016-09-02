<?php
# ***** BEGIN LICENSE BLOCK *****
# This file is part of Clearbricks.
# Copyright (c) 2006 Olivier Meunier and contributors.
# All rights reserved.
#
# Clearbricks is free software; you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation; either version 2 of the License, or
# (at your option) any later version.
# 
# Clearbricks is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
# 
# You should have received a copy of the GNU General Public License
# along with Clearbricks; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
#
# ***** END LICENSE BLOCK *****

require dirname(__FILE__).'/common/_main.php';

# Database Abstraction Layer
$__autoload['dbLayer']		= dirname(__FILE__).'/dblayer/dblayer.php';
$__autoload['dbStruct']		= dirname(__FILE__).'/dbschema/class.dbstruct.php';
$__autoload['dbSchema']		= dirname(__FILE__).'/dbschema/class.dbschema.php';

# Files Manager
$__autoload['filemanager']	= dirname(__FILE__).'/filemanager/class.filemanager.php';
$__autoload['fileItem']		= dirname(__FILE__).'/filemanager/class.filemanager.php';

# Feed Reader
$__autoload['feedParser']	= dirname(__FILE__).'/net.http.feed/class.feed.parser.php';
$__autoload['feedReader']	= dirname(__FILE__).'/net.http.feed/class.feed.reader.php';

# HTML Filter
$__autoload['htmlFilter']	= dirname(__FILE__).'/html.filter/class.html.filter.php';

# HTML Validator
$__autoload['htmlValidator']	= dirname(__FILE__).'/html.validator/class.html.validator.php';

# Image Manipulation Tools
$__autoload['imageMeta']		= dirname(__FILE__).'/image/class.image.meta.php';
$__autoload['imageTools']	= dirname(__FILE__).'/image/class.image.tools.php';

# Send Mail Utilities
$__autoload['mail']			= dirname(__FILE__).'/mail/class.mail.php';

# Mail Convert and Rewrap
$__autoload['mailConvert']	= dirname(__FILE__).'/mail.convert/class.mail.convert.php';

# Send Mail Through Sockets
$__autoload['socketMail']	= dirname(__FILE__).'/mail/class.socket.mail.php';

# Mime Message Parser
$__autoload['mimeMessage']	= dirname(__FILE__).'/mail.mime/class.mime.message.php';

# HTML Pager
$__autoload['pager']		= dirname(__FILE__).'/pager/class.pager.php';

# REST Server
$__autoload['restServer']	= dirname(__FILE__).'/rest/class.rest.php';
$__autoload['xmlTag']		= dirname(__FILE__).'/rest/class.rest.php';

# Database PHP Session
$__autoload['sessionDB']		= dirname(__FILE__).'/session.db/class.session.db.php';

# Simple Template Systeme
$__autoload['template']		= dirname(__FILE__).'/template/class.template.php';

# URL Handler
$__autoload['urlHandler']	= dirname(__FILE__).'/url.handler/class.url.handler.php';

# Wiki to XHTML Converter
$__autoload['wiki2xhtml']	= dirname(__FILE__).'/text.wiki2xhtml/class.wiki2xhtml.php';

# SQL Batch on XML Files
$__autoload['xmlsql']		= dirname(__FILE__).'/xmlsql/class.xmlsql.php';

# Common Socket Class
$__autoload['netSocket']		= dirname(__FILE__).'/net/class.net.socket.php';

# HTTP Client
$__autoload['netHttp']		= dirname(__FILE__).'/net.http/class.net.http.php';
$__autoload['HttpClient']	= dirname(__FILE__).'/net.http/class.net.http.php';

# NNTP Client
$__autoload['netNntp']		= dirname(__FILE__).'/net.nntp/class.net.nntp.php';
$__autoload['nntpMessage']	= dirname(__FILE__).'/net.nntp/class.nntp.message.php';

# XML-RPC Client and Server
$__autoload['IXR_Value']				= dirname(__FILE__).'/ext/incutio.ixr_library.php';
$__autoload['IXR_Message']			= dirname(__FILE__).'/ext/incutio.ixr_library.php';
$__autoload['IXR_Server']			= dirname(__FILE__).'/ext/incutio.ixr_library.php';
$__autoload['IXR_Request']			= dirname(__FILE__).'/ext/incutio.ixr_library.php';
$__autoload['IXR_Client']			= dirname(__FILE__).'/ext/incutio.ixr_library.php';
$__autoload['IXR_Error']				= dirname(__FILE__).'/ext/incutio.ixr_library.php';
$__autoload['IXR_Date']				= dirname(__FILE__).'/ext/incutio.ixr_library.php';
$__autoload['IXR_Base64']			= dirname(__FILE__).'/ext/incutio.ixr_library.php';
$__autoload['IXR_IntrospectionServer']	= dirname(__FILE__).'/ext/incutio.ixr_library.php';
$__autoload['IXR_ClientMulticall']		= dirname(__FILE__).'/ext/incutio.ixr_library.php';

$__autoload['xmlrpcValue']				= dirname(__FILE__).'/net.xmlrpc/class.net.xmlrpc.php';
$__autoload['xmlrpcMessage']				= dirname(__FILE__).'/net.xmlrpc/class.net.xmlrpc.php';
$__autoload['xmlrpcRequest']				= dirname(__FILE__).'/net.xmlrpc/class.net.xmlrpc.php';
$__autoload['xmlrpcDate']				= dirname(__FILE__).'/net.xmlrpc/class.net.xmlrpc.php';
$__autoload['xmlrpcBase64']				= dirname(__FILE__).'/net.xmlrpc/class.net.xmlrpc.php';
$__autoload['xmlrpcClient']				= dirname(__FILE__).'/net.xmlrpc/class.net.xmlrpc.php';
$__autoload['xmlrpcClientMulticall']		= dirname(__FILE__).'/net.xmlrpc/class.net.xmlrpc.php';
$__autoload['xmlrpcServer']				= dirname(__FILE__).'/net.xmlrpc/class.net.xmlrpc.php';
$__autoload['xmlrpcIntrospectionServer']	= dirname(__FILE__).'/net.xmlrpc/class.net.xmlrpc.php';

# Zip tools
$__autoload['fileUnzip']		= dirname(__FILE__).'/zip/class.unzip.php';
$__autoload['fileZip']		= dirname(__FILE__).'/zip/class.zip.php';
?>