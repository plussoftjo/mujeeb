<template>
	<div class="index ff">
		<v-card :style="{backgroundImage:'url(' + images.header_bg + ')'}">
			<v-container>
				<v-layout align-center justify-center fill-height>
					<h1 style="color: #ffcc00;">Mujeeb Mobile App</h1>
				</v-layout>
				<v-layout align-center justify-center fill-height>
					<div style="width: 100px; padding: 10px 0px;">
						<hr>
					</div>
				</v-layout>
				<v-layout align-center justify-center fill-height>
					<h4 class="white--text" style="padding-top: 10px;">مجيب خدمات تصلك حيثما كنت في خطوات بسيطة</h4>
				</v-layout>

				<v-layout align-center justify-center fill-height style="padding-top: 10px;">
					<v-btn color="pink" dark>  Google Play  <v-icon>fab fa-google-play</v-icon> </v-btn>
					<v-btn dark >App Store <v-icon>fab fa-app-store</v-icon></v-btn>
				</v-layout>
			</v-container>
			<v-container>
				<v-layout align-center justify-center fill-height>
					<div class="pa-3">
						<img :src="images.appPreview" alt="">
					</div>	
				</v-layout>
			</v-container>
			<v-container>
				<v-layout  align-center justify-center fill-height>
					<v-flex xs12 md3>
						<div class="info_header">
							<v-icon color="#ffcc00" x-large>
								fas fa-user-tie
							</v-icon>
						</div>
						<div class="info_body">
							قدم لمجيب مشكلتك 
						</div>
					</v-flex>
					<v-flex xs12 md3>
						<div class="info_header">
							<v-icon color="#ffcc00" x-large>
								fas fa-search
							</v-icon>
						</div>
						<div class="info_body">
							ابحث عن افضل سعر تم تقديمه
						</div>
					</v-flex>
					<v-flex xs12 md3> 
						<div class="info_header">
							<v-icon color="#ffcc00" x-large>
								fas fa-calendar-alt
							</v-icon>
						</div>
						<div class="info_body">
							حدد الوقت المناسب لك 
						</div>
					</v-flex>
					<v-flex xs12 md3> 
						<div class="info_header">
							<v-icon color="#ffcc00" x-large>
								fas fa-vote-yea
							</v-icon>
						</div>
						<div class="info_body">
							قم بتقيم الخدمة
						</div>
					</v-flex>
				</v-layout>
			</v-container>
		</v-card>
		<v-card>
			<v-container>
				<v-layout align-center justify-center fill-height>
					<v-flex xs12 md6> 
						<h1 style="text-align: center; font-size: 44px;">عن مجيب </h1>
						<p style="text-align: center; font-size: 28px;">
							مجيب برنامج الخدمات المنزلية الاول يقدم لك خيارات متعددة في مجال الصيانة وغييره من الخدمات المميزة من خلال مجيب يمكنك متابعة افضل الاسعار للخدمات 
						</p>
					</v-flex>
					<v-flex xs12 md6>
						<img :src="img" alt="">
					</v-flex>
				</v-layout>
			</v-container>
		</v-card>
		<v-card class="yellow darken-2 pa-4">
			<v-layout align-center justify-center fill-height>
				<h1 style="font-size: 36px;">
					متوفر على قوقل بلاي وآب ستور
				</h1>
			</v-layout>
			<v-layout align-center justify-center fill-height class="pt-3">
				<img :src="ios" height="75" width="250" alt="" style="cursor: pointer;">
				<img :src="google" height="75" width="250" alt="" style="cursor: pointer;">
			</v-layout>
		</v-card>
		<v-footer class="pa-3 black">
		  <v-spacer></v-spacer>
		  <div class="white--text">Mujeeb App &copy; {{ new Date().getFullYear() }} </div>
		</v-footer>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				images:{header_bg:require('../../images/auth_home_bg.jpg'),appPreview:require('../../images/1.png')},
				img:require('../../preview.png'),
				ios:require('../../images/ios.png'),
				google:require('../../images/googleplay.png')
			}
		}
	}
</script>
<style>
	.info_header{
		text-align: center;
		color:#ffcc00;
	}
	.info_body{
		text-align: center;
		font-weight: 700;
		color:white;
		padding-top:10px;
	}
</style>