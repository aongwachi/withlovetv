<footer>
	<div class="container">
		<div class="row">
			<div class="col-xs-12 text-right">
			<p id="back-top">
			<a href="#top"><span><span class="glyphicon glyphicon-chevron-up"></span></span></a>
			</p>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-3 col-md-2 col-item">
				<div class="title-line">
					<h1>ด้วยรักทีวีดอทคอม</h1>
					<div class="line"></div>
				</div>
				<div class="row">
					<div class="col-xs-6">
						<ul class="list-nav">
						<li><a href="#">LIVE</a></li>
						<li><a href="#">ดูย้อนหลัง</a></li>
						<?php
						$CountMenu=0;
						//##########################################################################################
						$sql=" SELECT COUNT(*) FROM ".TABLE_CATEGORY." WHERE ".TABLE_CATEGORY."_Name<>'' AND ".TABLE_CATEGORY."_Folder<>'' ";
						$sql.=" AND ".TABLE_CATEGORY."_isMainMenu='1' ";
						$query=$dbh->prepare($sql);
						if($query->execute()) {
						    $Row=$query->fetch();
						    $CountMenu=$Row[0];
						}
						$maxRow=ceil(($CountMenu+3)/2);
						//##########################################################################################
						$loopi=2;
						$sql=" SELECT * FROM ".TABLE_CATEGORY." WHERE ".TABLE_CATEGORY."_Name<>'' AND ".TABLE_CATEGORY."_Folder<>'' ";
						$sql.=" AND ".TABLE_CATEGORY."_isMainMenu='1' ";
						$sql.=" ORDER BY ".TABLE_CATEGORY."_Ordering ASC ";
						$query=$dbh->prepare($sql);
						if($query->execute()) {
						while($Row=$query->fetch()) {
							?>
							<li><a href="list.php?catid=<?php echo $Row[TABLE_CATEGORY."_ID"]; ?>&page=1"><?php echo $Row[TABLE_CATEGORY."_Name"]; ?></a></li>
							<?php
							$loopi++;
							if($loopi==$maxRow) {
								echo '</ul></div><div class="col-xs-6"><ul class="list-nav">';
							}
						}} else { print_r($query->errorInfo()); }
						//##########################################################################################
						?>
						<li><a href="#">ติดต่อเรา</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-xs-0 col-sm-0 col-md-1"></div>
			<div class="col-xs-12 col-sm-3 col-md-2 col-item">
				<div class="title-line">
					<h1>LASTEST NEWs</h1>
				<div class="line"></div>
				</div>
				<ul class="list-nav">
				<?php
				//##########################################################################################
				$sql="SELECT * FROM ".TABLE_CONTENT." WHERE ".TABLE_CONTENT."_Thumb<>'' AND ".TABLE_CONTENT."_Subject<>'' AND ".TABLE_CONTENT."_Text<>'' AND ".TABLE_CONTENT."_Status='Publish' ORDER BY ".TABLE_CONTENT."_OnlineDate DESC LIMIT 0,".($maxRow)." ";
				$query=$dbh->prepare($sql);
				if($query->execute()) {
				while($Row=$query->fetch()) {
					$myID=$Row[TABLE_CONTENT."_ID"];
					$mySubject=mb_substr($Row[TABLE_CONTENT."_Subject"],0,70,'UTF-8');
					?>
					<li><a href="detail.php?p=<?php echo $myID; ?>"><?php echo trim($mySubject); ?></a></li>
					<?php
				}} else { print_r($query->errorInfo()); }
				//##########################################################################################
				?>
				</ul>
			</div>
			<div class="col-xs-0 col-sm-0 col-md-1"></div>
				<div class="col-xs-12 col-sm-3 col-md-2 col-item">
				<div class="title-line">
					<h1>Popular tags</h1>
					<div class="line"></div>
				</div>
				<div class="row">
					<div class="col-xs-6">
						<ul class="list-nav">
						<?php
						$loopi=0;
						$sql=" SELECT * FROM ".TABLE_TAGS." WHERE ".TABLE_TAGS."_Name<>'' AND ".TABLE_TAGS."_NoOfUse>0 ";
						$sql.=" ORDER BY ".TABLE_TAGS."_NoOfUse DESC LIMIT 0,".($maxRow*2)." ";
						$query=$dbh->prepare($sql);
						if($query->execute()) {
							while($Row=$query->fetch()) {
								?>
								<li><a href="tags.php?tagid=<?php echo $Row[TABLE_TAGS."_ID"]; ?>">#<?php echo $Row[TABLE_TAGS."_Name"]; ?></a></li>
								<?php
								$loopi++;
								if($loopi==$maxRow) {
									echo '</ul></div><div class="col-xs-6"><ul class="list-nav">';
								}
							}
						} else { print_r($query->errorInfo()); }
						?>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-xs-0 col-sm-0 col-md-1"></div>
			<div class="col-xs-12 col-sm-2 col-md-2 col-item">
				<div class="title-line">
					<h1>connect with us</h1>
					<div class="line"></div>
				</div>
				<ul class="list-inline list-icon">
					<li><a href="#"><i class="fa fa-twitter"></i></a></li>
					<li><a href="#"><i class="fa fa-facebook"></i></a></li>
					<li><a href="#"><i class="fa fa-youtube"></i></a></li>
					<li><a href="#"><i class="fa fa-instagram"></i></a></li>
				</ul>
	        </div>
	        <div class="col-xs-0 col-sm-0 col-md-1"></div>
		</div>
    </div>
    <div class="copyright">
        <div class="col-xs-12">
	Copyright © All Rights Reserved 2016 ด้วยรักทีวี.com
        </div>
    </div>
</footer>
</body>
</html>