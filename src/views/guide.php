<p>This document came from: http://www.queen.clara.net/pgp/art3.html, "Nat Queen" has nothing to do with this hidden service.</p>

<H1>Beginner's Guide to GnuPG</H1>

<B>by Nat Queen</B>

<P><I>[Note. This is a slightly modified version of an article that originally
appeared in the August 2001 issue of Archive magazine.  It is written
specifically for users of RISC OS computers, but much of the information
applies equally to other versions of GnuPG.]</I>

<P>This year marks the tenth anniversary of a momentous event in the history
of computing - freeware PGP (Pretty Good Privacy), created by Philip
Zimmermann, became available to the world, thereby providing strong
public-key cryptography for the masses.

<P>PGP soon became the worldwide standard program for secure email over the
internet. Versions are now available for all major operating systems. GnuPG
(GNU Privacy Guard), developed more recently, is an alternative to PGP,
which is generally compatible with all modern PGP versions.

<P>Although GnuPG can do all the same things as PGP (and even more!), it is
not so well known. However, for reasons to be explained below, it is now
becoming important for RISC OS users.

<P>Readers who are not already familiar with PGP may find it helpful to
consult my previous articles <A HREF="art1.html">"PGP for secure e-mail"</A>
and <A HREF="art2.html">"Beginner's guide to PGP"</A>. An understanding of
the basic concepts of public-key cryptography is essential for the proper
use of GnuPG, as it is for PGP, and these concepts will not be repeated
here.

<P>The latest RISC OS version of PGP is 2.6.3ia, which was ported by Gareth
McCaughan from the corresponding DOS version in 1997. Sadly, it is becoming
seriously outdated. Windows users now have PGP 7, and versions 5 or 6 are
available for most other operating systems. These later versions use a
greater variety of algorithms for encryption and digital signatures, some of
which are now more widely used. As a result, it has become difficult for
RISC OS users to communicate securely with users of the more modern versions
of PGP for other operating systems.

<H2>GnuPG to the rescue</H2>

GnuPG is an open-source program, originally written for Linux or Unix
systems and released under the GNU General Public Licence (GPL). This means
that its source code is freely available and that the program may be used
freely by anyone. GnuPG is fully compliant with the OpenPGP standard of the
Internet Engineering Task Force (IETF).

<P> What is the relevance of all this to RISC OS users? A RISC OS port of
GnuPG was created recently by Stefan Bellon (see <A
HREF="http://www.sbellon.de/gnupg.html">http://www.sbellon.de/gnupg.html</A>),
thus bringing RISC OS users up to date with the latest OpenPGP standards and
enabling them to intercommunicate securely with users of all versions of
PGP. In fact, GnuPG now provides all the same basic functionality as the
latest Windows versions of PGP.

<H2>The command line</H2>

The downside is that GnuPG, like the ageing RISC OS version of PGP, can be
used only from the command line. New users may be bewildered by the huge
number of possible commands of GnuPG, but fortunately only a few basic
commands are needed for most practical purposes. Nevertheless, until someone
writes a convenient front end for GnuPG, it will be necessary to learn to
use at least some of these commands in order to take advantage of this
powerful program.

<P>The reason why the RISC OS port of GnuPG is a command-line program is
that it was created  so as to mimic exactly the commands and functions of
the original Unix-like version. This will make it easier to update the
program if any enhancements are made to the original version. Indeed, such
updates have already been released.

<P>In an article such as this, it is impossible to explain all the commands
fully, or even to mention all the things that GnuPG can do. My objective
here is to give only enough detail to enable a beginner to make use of the
main features of GnuPG for secure e-mail. I hope that this article will also
be helpful to experienced PGP users, who will need to learn a somewhat
different set of commands for GnuPG.

<H2>Installing GnuPG</H2>

The installation procedure is simple. Download the archive "gnupg/zip" from
Stefan Bellon's URL given above. This archive contains two applications,
!GnuPG and !GnuPGUser, as well as some documentation.

<P>Copy the entire contents of the archive to any convenient directory. It
is important, however, that the two applications reside in a filing system
that supports long filenames. If you do not have RISC OS 4 with an E+
formatted medium, you can use the raFS filing system (available from
<A HREF="http://atterer.net/riscos.html">
http://atterer.net/riscos.html</A>) or any other filing
system that allows long filenames.

<P>!GnuPG is the application that does all the work. !GnuPGUser will contain
all the data referring to you as an individual user, including your public
and secret keyrings and certain user-defined options. Both of these
applications must be "seen" by the filer before you can use GnuPG. If you
intend to use GnuPG frequently, it is best to ensure that the filer "sees"
them during startup of your computer by placing appropriate references to
them in your boot sequence. Some advice about how to do this is contained in
the !Help file inside !GnuPG.

<P>Your installation is not yet complete. GnuPG requires a good source of
pseudo-random numbers. For this purpose, the RISC OS version of GnuPG makes
use of a module called CryptRandom by Theo Markettos. If you do not already
have a copy of this module, download the CryptRandom binary from Theo's
website at <A HREF="http://www.markettos.org.uk/riscos/crypto/">
http://www.markettos.org.uk/riscos/crypto/</A>. A copy of the module
CryptRandom (with filename "CryptRand") should be placed inside the !GnuPG
directory.

<H2>Compatibility with the old PGP</H2>

There are certain difficulties in using GnuPG to communicate with people who
are still using PGP 2.x. First and foremost, GnuPG does not support the IDEA
cipher, which is an essential component of PGP 2.x. This is a deliberate
omission. The IDEA cipher is patented by the Swiss company Ascom-Tech AG,
and a licence is required to use it for commercial purposes, at least in
some countries (though it may be used freely for non-commercial purposes).
Such a restriction is incompatible with the terms of the GPL, and therefore
IDEA is not implemented in any official version of GnuPG.

<P>Stefan Bellon provides a simple way of overcoming this difficulty and
maintaining compatibility with the old PGP 2.x. On his website there are two
additional archives, "gnupgidea/zip" and "gnupgpart/zip". These are an IDEA
archive and a partially linked GnuPG archive. Using them, it is possible to
build your own IDEA-compliant version of GnuPG. To do this, follow the
simple instructions in the !ReadMe file contained in the IDEA archive.

<P>Note that if you add IDEA functionality to your copy of GnuPG, you should
not use the IDEA algorithm for commercial purposes or distribute the
enlarged program again under the GPL.

<P>Even after IDEA is added to GnuPG, there are still some complications in
using it to communicate with users of PGP 2.x. A detailed explanation of how
to use GnuPG as a nearly complete replacement for PGP 2.x can be found in a
document "pgp2x.html" contained inside the GnuPG distribution. However, if
you need to exchange messages with PGP 2.x users, you may find it simplest,
at least initially, to use the old PGP 2.6.3ia for this purpose, especially
if you have already been using PGP for this purpose.

<H2>Importing and generating keys</H2>

Public and secret keys are required in order to use GnuPG for secure email.
These keys are stored in two files called public and secret keyrings. If you
are already a user of any version of PGP, you can import your existing
keyrings into GnuPG. To import a public keyring, use the command

<P><TT>gpg --import &lt;keyfile&gt;</TT>

<P>where &lt;keyfile&gt; denotes the filename of the keyring file. If this
keyring file is not in your currently selected directory, you will need to
specify its full pathname. The same command can be used to import a public
key sent to you by another user of PGP or GnuPG.

<P>When importing keys, GnuPG behaves differently from PGP in at least two
respects. First, in its default mode of operation GnuPG will not import keys
which are not self-signed. Second, contrary to what an experienced PGP user
might expect, the simple command "<TT>gpg &lt;keyfile&gt;</TT>" does not
offer the option of adding any keys to your keyring; it is essential to use
the "import" command as above.

<P>A somewhat more complex command is required to import a secret keyring:

<P><TT>gpg --allow-secret-key-import --import &lt;keyfile&gt;</TT>

<P>Note the use of double dashes in GnuPG commands, in contrast to PGP,
which uses only single dashes. However, certain GnuPG commands have standard
single-letter abbreviations, which are preceded by only a single dash. For
example, you can obtain a list of all the main commands by typing "<TT>gpg
--help</TT>" or, in abbreviated form, "<TT>gpg -h</TT>".

<P>If you have not previously used any version of PGP, you will need to
generate new keys. To do this, enter the command

<P><TT>gpg --gen-key</TT>

<P>GnuPG will then offer a choice of several options. It is recommended that
you select the default option ("DSA and ElGamal") for the key types, unless
you have a special reason for some other choice. To ensure high security for
the foreseeable future, you should choose a reasonably large key size. GnuPG
will also ask for your name and e-mail address, which together form a user
ID to identify your key.

<P>Even if you already have an RSA key pair from previous use of PGP, it is
still highly desirable to generate new keys as described above, since RSA
keys are deprecated in GnuPG and in some later versions of PGP.

<H2>Listing your keys</H2>

You can view basic details of any particular key in your public keyring by
typing the command

<P><TT>gpg --list-keys &lt;name&gt;</TT>

<P>where &lt;name&gt; is the user ID of the key, or (more conveniently) any
substring of it which specifies it uniquely. As an example, for one of my
key pairs you would get the following output:

<P><TT>pub 1024D/6B71EC75 2000-08-29 Nat M. Queen &lt;n.m.queen@birmingham.ac.uk&gt;
<BR>sub 4097g/34100D21 2000-08-29</TT>

<P>Here the upper line describes a 1024-bit DSA signing key with key ID
6B71EC75. The rest of the line gives the date on which the key was created
and its user ID. The lower line describes a 4097-bit ElGamal encryption key
with key ID 34100D21. Note that in general different keys are used for
signing and for encryption, and the encryption key is usually larger. The
signing and encryption keys are generated together by the single command
described above.

<P>To view details of <I>all</I> the keys in your public keyring, use the
same command as above, but without the parameter &lt;name&gt;.

<P>If you have more than one secret key, you can set one of them as your
default key. This is the key that GnuPG will use to create digital
signatures. To specify a default key, uncomment the "default-key" line in
the GnuPG options file "!GnuPGUser.options" (by deleting the initial "#"
character on that line) and add the appropriate key ID at the end of the
line.

<H2>Receiving encrypted messages</H2>

If other users of PGP or GnuPG are to send you encrypted messages, they must
have your public key in their keyrings. If you have just generated a new
key, you can extract it into a file by means of the command

<P><TT>gpg --export -o &lt;keyfile&gt; &lt;name&gt;</TT>

<P>where &lt;keyfile&gt; is the filename of the output file into which you
want the public key to be extracted, and &lt;name&gt; specifies the key as
described above. You can then send the keyfile to other users who want to
communicate with you.

<P>If an exported keyfile is to be included as part of an e-mail message,
you should ensure that it is "ASCII-armoured". This will automatically be
the case if the "armor" line in the GnuPG options file is uncommented, which
is in fact the default configuration. (The RISC OS port of GnuPG retains the
American spelling "armor" in its options file, as in the original version,
although both spellings are actually accepted.) This setting will also
ensure that all messages encrypted by GnuPG will be ASCII-armoured.

<P>Suppose now that you receive an encrypted file from someone. You can
decrypt it by means of the simple command "<TT>gpg &lt;file&gt;</TT>", where
&lt;file&gt; is the filename. GnuPG will check that you have the secret key
required to decrypt the file and, if so, it will ask for your passphrase for
accessing that key. If the file that you decrypt contains a digital
signature of the sender, GnuPG will report this fact and tell you whether
the signature is "good". A good signature confirms that the file is
identical to the one originally signed by the sender.

<P>GnuPG will be able to check a signature only if the signatory's public
key is in your keyring. If the required public key cannot be found in your
keyring, GnuPG will automatically search a keyserver for it if you are
online, or if your internet setup allows auto-dial-in. In that case, if the
key is found, it will be downloaded and imported. Otherwise, if GnuPG is
unable to connect to the internet, it will simply report that it is
requesting the key from a keyserver, and the process will appear to hang.
You can stop this by pressing &lt;Escape&gt;.


<H2>Sending encrypted messages</H2>


 Before you can encrypt a message for
someone else, that person's public key must be in your public keyring. If
you receive someone's public key, you can add it to your public keyring by
means of the "import" command described earlier.

<P>To encrypt a file for someone, use the command

<P><TT>gpg -e -r &lt;name&gt; &lt;file&gt;</TT>

<P>where &lt;name&gt; specifies the user ID of the intended recipient's key,
and &lt;file&gt; is the filename. It is also possible to encrypt a file
simultaneously for any number of multiple recipients by means of a command
of the form

<P><TT>gpg -e -r &lt;name1&gt; -r &lt;name2&gt; ... &lt;file&gt;</TT>

<P>To add a digital signature to an encrypted message, simply replace the
"-e" by "-se" in the encryption command. In this case, GnuPG will ask for
your passphrase for accessing your secret key.

<P>If you want to be able to decrypt all your encrypted messages yourself,
you should uncomment the "encrypt-to" line in the GnuPG options file and
insert your key ID at the end of that line. Users of PGP will recognise that
this serves the same function as its "encrypt-to-self" option, i.e. it
encrypts all messages automatically with your own public key in addition to
that of the specified recipients.

<P>The commands described above should be sufficient to enable you to send
and receive encrypted e-mail and to have "Pretty Good Privacy". In a future
article I shall describe some of the other things you can do with GnuPG.

<P>Finally, I thank Stefan Bellon for kindly suggesting some improvements to
a draft of this article. Any remaining inaccuracies are, of course, entirely
my own.
