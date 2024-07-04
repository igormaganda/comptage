<?php
	// require_once("../../sdatamart/lib/system_load.php");
	//user Authentication.
	// authenticate_user('all');
	
	$graph = true;
	$home = true;
	
    include 'header-main.php'; 
	
	
	require_once("../class/Bdd.php");
	$bdd = new Bdd();

	$home1 = "SELECT * FROM home1 ORDER BY id DESC LIMIT 2";
	$recupHome1   = $bdd->executeQueryRequete($home1, 1);

	$tour = 1;
	while( $item = $recupHome1->fetch() ) {
		if ($tour == 1) {
			$fullbase    = $item->fullbase;
			$email       = $item->email;
			$blacklist   = $item->blacklist;
			$domaines    = $item->domaines;
			$hommes      = $item->hommes;
			$dames       = $item->dames;
			$demoiselles = $item->demoiselles;
			$btoc        = $item->btoc;
			$btob        = $item->btob;
			$sb          = $item->sb;
			$hb          = $item->hb;
			$st          = $item->st;
			$unsub       = $item->unsub;
		} else {
			$fullbase2    = $fullbase-$item->fullbase;
			$email2       = $email-$item->email;
			$blacklist2   = $blacklist-$item->blacklist;
			$domaines2    = $domaines-$item->domaines;
			$hommes2      = $hommes-$item->hommes;
			$dames2       = $dames-$item->dames;
			$demoiselles2 = $demoiselles-$item->demoiselles;
			$btoc2        = $btoc-$item->btoc;
			$btob2        = $btob-$item->btob;
			$sb2          = $sb-$item->sb;
			$hb2          = $hb-$item->hb;
			$st2          = $st-$item->st;
			$unsub2       = $unsub-$item->unsub;
		}
		$tour++;
	}

	if ($fullbase == 0) $fullbase = 1;
?>


<script defer src="/<?php echo $path; ?>/assets/js/apexcharts.js"></script>
<div x-data="finance">
    <ul class="flex space-x-2 rtl:space-x-reverse">
        <li>
            <a href="javascript:;" class="text-primary hover:underline">Dashboard</a>
        </li>
        <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
            <span></span>
        </li>
    </ul>
    <div class="pt-5">
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-5 gap-6 mb-6 text-white">
            <!-- Users Visit -->
            <div class="panel bg-gradient-to-r from-cyan-500 to-cyan-400">
                <div class="flex justify-between">
                    <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">E-mail</div>
                    <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                        <a href="javascript:;" @click="toggle">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hover:opacity-80 opacity-70">
                                <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                            </svg>
                        </a>
                        <ul x-cloak x-show="open" x-transition x-transition.duration.300ms class="ltr:right-0 rtl:left-0 text-black dark:text-white-dark">
                            <li><a href="javascript:;" @click="toggle">View Report</a></li>
                            <li><a href="javascript:;" @click="toggle">Edit Report</a></li>
                        </ul>
                    </div>
                </div>
                <div class="flex items-center mt-5">
                    <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3"> <?php echo number_format($email, 0, "", " "); ?> </div>
                </div>
                <div class="flex items-center font-semibold mt-5">
                    <div class="badge bg-white/30"><?php echo $email2>=0 ? '<span class="blue">' : '<span class="red">'; echo number_format($email2, 0, "", " "); ?></div> 
                </div>
            </div>

            <!-- Sessions -->
            <div class="panel bg-gradient-to-r from-violet-500 to-violet-400">
                <div class="flex justify-between">
                    <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">Domaines</div>
                    <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                        <a href="javascript:;" @click="toggle">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hover:opacity-80 opacity-70">
                                <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                            </svg>
                        </a>
                        <ul x-cloak x-show="open" x-transition x-transition.duration.300ms class="ltr:right-0 rtl:left-0 text-black dark:text-white-dark">

                            <li><a href="javascript:;" @click="toggle">View Report</a></li>
                            <li><a href="javascript:;" @click="toggle">Edit Report</a></li>

                        </ul>
                    </div>
                </div>
                <div class="flex items-center mt-5">
                    <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3"> <?php echo number_format($domaines, 0, "", " "); ?></div>
                </div>
                <div class="flex items-center font-semibold mt-5">
                    
                <div class="badge bg-white/30"><?php echo $domaines2>=0 ? '<span class="blue">' : '<span class="red">'; echo number_format($domaines2, 0, "", " "); ?> </div> 
                </div>
            </div>

            <!-- Time On-Site -->
            <div class="panel bg-gradient-to-r from-blue-500 to-blue-400">
                <div class="flex justify-between">
                    <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">Hommes</div>
                    <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                        <a href="javascript:;" @click="toggle">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hover:opacity-80 opacity-70">
                                <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                            </svg>
                        </a>
                        <ul x-cloak x-show="open" x-transition x-transition.duration.300ms class="ltr:right-0 rtl:left-0 text-black dark:text-white-dark">
                            <li><a href="javascript:;" @click="toggle">View Report</a></li>
                            <li><a href="javascript:;" @click="toggle">Edit Report</a></li>

                        </ul>
                    </div>
                </div>
                <div class="flex items-center mt-5">
                    <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3"> <?php echo number_format($hommes, 0, "", " "); ?></div>
                </div>
                <div class="flex items-center font-semibold mt-5">
                    
                <div class="badge bg-white/30"><?php echo $hommes2>=0 ? '<span class="blue">' : '<span class="red">'; echo number_format($hommes2, 0, "", " "); ?></div>
                </div>
            </div>

            <!-- Bounce Rate -->
            <div class="panel bg-gradient-to-r from-fuchsia-500 to-fuchsia-400">
                <div class="flex justify-between">
                    <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">Dames</div>
                    <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                        <a href="javascript:;" @click="toggle">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hover:opacity-80 opacity-70">
                                <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                            </svg>
                        </a>
                        <ul x-cloak x-show="open" x-transition x-transition.duration.300ms class="ltr:right-0 rtl:left-0 text-black dark:text-white-dark">
                            <li><a href="javascript:;" @click="toggle">View Report</a></li>
                            <li><a href="javascript:;" @click="toggle">Edit Report</a></li>

                        </ul>
                    </div>
                </div>
                <div class="flex items-center mt-5">
                    <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3"><?php echo number_format($dames, 0, "", " "); ?></div>
                </div>
                <div class="flex items-center font-semibold mt-5">
                    <div class="badge bg-white/30"><?php echo $dames2>=0 ? '<span class="blue">' : '<span class="red">'; echo number_format($dames2, 0, "", " "); ?> </div>
                </div>
            </div>
            <div class="panel bg-gradient-to-r from-fuchsia-500 to-fuchsia-400 md:col-span-6">
                <div class="flex justify-between">
                    <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">Demoiselles</div>
                    <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                        <a href="javascript:;" @click="toggle">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hover:opacity-80 opacity-70">
                                <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                            </svg>
                        </a>
                        <ul x-cloak x-show="open" x-transition x-transition.duration.300ms class="ltr:right-0 rtl:left-0 text-black dark:text-white-dark">
                            <li><a href="javascript:;" @click="toggle">View Report</a></li>
                            <li><a href="javascript:;" @click="toggle">Edit Report</a></li>

                        </ul>
                    </div>
                </div>
                <div class="flex items-center mt-5">
                    <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3"> <?php echo number_format($demoiselles, 0, "", " "); ?> </div>
                </div>
                <div class="flex items-center font-semibold mt-5">
                    <div class="badge bg-white/30"><?php echo $demoiselles2>=0 ? '<span class="blue">' : '<span class="red">'; echo number_format($demoiselles2, 0, "", " "); ?></div>
                </div>
            </div>
       
            <!-- Users Visit -->
            <div class="panel bg-gradient-to-r from-cyan-500 to-cyan-400">
                <div class="flex justify-between">
                    <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">B2C</div>
                    <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                        <a href="javascript:;" @click="toggle">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hover:opacity-80 opacity-70">
                                <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                            </svg>
                        </a>
                        <ul x-cloak x-show="open" x-transition x-transition.duration.300ms class="ltr:right-0 rtl:left-0 text-black dark:text-white-dark">
                            <li><a href="javascript:;" @click="toggle">View Report</a></li>
                            <li><a href="javascript:;" @click="toggle">Edit Report</a></li>
                        </ul>
                    </div>
                </div>
                <div class="flex items-center mt-5">
                    <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3"> <?php echo number_format($btoc, 0, "", " "); ?> </div>
                </div>
                <div class="flex items-center font-semibold mt-5">
                    <div class="badge bg-white/30"><?php echo $btoc2>=0 ? '<span class="blue">' : '<span class="red">'; echo number_format($btoc2, 0, "", " "); ?></div>
                </div>
            </div>

            <!-- Sessions -->
            <div class="panel bg-gradient-to-r from-violet-500 to-violet-400">
                <div class="flex justify-between">
                    <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">B2B</div>
                    <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                        <a href="javascript:;" @click="toggle">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hover:opacity-80 opacity-70">
                                <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                            </svg>
                        </a>
                        <ul x-cloak x-show="open" x-transition x-transition.duration.300ms class="ltr:right-0 rtl:left-0 text-black dark:text-white-dark">

                            <li><a href="javascript:;" @click="toggle">View Report</a></li>
                            <li><a href="javascript:;" @click="toggle">Edit Report</a></li>

                        </ul>
                    </div>
                </div>
                <div class="flex items-center mt-5">
                    <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3"> <?php echo number_format($btob, 0, "", " "); ?> </div>
                </div>
                <div class="flex items-center font-semibold mt-5">
                    <div class="badge bg-white/30"><?php echo $btob2>=0 ? '<span class="blue">' : '<span class="red">'; echo number_format($btob2, 0, "", " "); ?></div>
                </div>
            </div>

            <!-- Time On-Site -->
            <div class="panel h-full overflow-hidden before:bg-[#1937cc] before:absolute before:-right-44 before:top-0 before:bottom-0 before:m-auto before:rounded-full before:w-96 before:h-96 grid grid-cols-1 content-between" style="background:linear-gradient(0deg,#00c6fb -227%,#005bea)!important;">
                <div class="flex justify-between">
                    <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">Total SB</div>
                    <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                        <a href="javascript:;" @click="toggle">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hover:opacity-80 opacity-70">
                                <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                            </svg>
                        </a>
                        <ul x-cloak x-show="open" x-transition x-transition.duration.300ms class="ltr:right-0 rtl:left-0 text-black dark:text-white-dark">
                            <li><a href="javascript:;" @click="toggle">View Report</a></li>
                            <li><a href="javascript:;" @click="toggle">Edit Report</a></li>

                        </ul>
                    </div>
                </div>
                <div class="flex items-center mt-5">
                    <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3"><?php echo number_format($sb, 0, "", " "); ?></div>
                </div>
                <div class="flex items-center font-semibold mt-5">
                    <div class="badge bg-white/30"><?php echo $sb2>=0 ? '<span class="blue">' : '<span class="red">'; echo number_format($sb2, 0, "", " "); ?></div>
                </div>
            </div>

            <!-- Bounce Rate -->
            <div class="panel h-full overflow-hidden before:bg-[#1937cc] before:absolute before:-right-44 before:top-0 before:bottom-0 before:m-auto before:rounded-full before:w-96 before:h-96 grid grid-cols-1 content-between" style="background:linear-gradient(0deg,#00c6fb -227%,#005bea)!important;">
                <div class="flex justify-between">
                    <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">Total HB</div>
                    <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                        <a href="javascript:;" @click="toggle">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hover:opacity-80 opacity-70">
                                <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                            </svg>
                        </a>
                        <ul x-cloak x-show="open" x-transition x-transition.duration.300ms class="ltr:right-0 rtl:left-0 text-black dark:text-white-dark">
                            <li><a href="javascript:;" @click="toggle">View Report</a></li>
                            <li><a href="javascript:;" @click="toggle">Edit Report</a></li>

                        </ul>
                    </div>
                </div>
                <div class="flex items-center mt-5">
                    <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3"> <?php echo number_format($hb, 0, "", " "); ?> </div>
                </div>
                <div class="flex items-center font-semibold mt-5">
                    <div class="badge bg-white/30"><?php echo $hb2>=0 ? '<span class="blue">' : '<span class="red">'; echo number_format($hb2, 0, "", " "); ?> </div>
                </div>
            </div>
            <div class="min-h-[190px] bg-gradient-to-r from-[#4361ee] to-[#160f6b] p-6">
                <div class="flex justify-between">
                    <div class="ltr:mr-1 rtl:ml-1 text-md font-semibold">Total désabonnés</div>
                    <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                        <a href="javascript:;" @click="toggle">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hover:opacity-80 opacity-70">
                                <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                            </svg>
                        </a>
                        <ul x-cloak x-show="open" x-transition x-transition.duration.300ms class="ltr:right-0 rtl:left-0 text-black dark:text-white-dark">
                            <li><a href="javascript:;" @click="toggle">View Report</a></li>
                            <li><a href="javascript:;" @click="toggle">Edit Report</a></li>

                        </ul>
                    </div>
                </div>
                <div class="flex items-center mt-5">
                    <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3"> <?php echo number_format($unsub, 0, "", " "); ?> </div>
                </div>
                <div class="flex items-center font-semibold mt-5">
                    <div class="badge bg-white/30"><?php echo $unsub2>=0 ? '<span class="blue">' : '<span class="red">'; echo number_format($unsub2, 0, "", " "); ?></div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-1 xl:grid-cols-3 gap-6 mb-6">
            <div class="panel h-full">
                <div class="flex items-start justify-between mb-5">
                    <h5 class="font-semibold text-lg dark:text-white-light">Top Countries</h5>
                </div>
                <div class="flex flex-col space-y-5">
                    <template x-for="item in languages">
                        <div class="flex items-center">
                            <div class="w-9 h-9">
                                <img class="w-5 h-5 object-cover rounded-full" :src="`/<?php echo $path; ?>/assets/images/flags/${item.value.toUpperCase()}.svg`" alt="image" />
                            </div>
                            <div class="px-3 flex-initial w-full">
                                <div class="w-summary-info flex justify-between font-semibold text-white-dark mb-1">
                                    <h6><span class="ltr:ml-3 rtl:mr-3" x-text="item.key"></span></h6>
                                    <p class="ltr:ml-auto rtl:mr-auto text-xs"><span class="ltr:ml-3 rtl:mr-3" x-text="item.count"></span>%</p>
                                </div>
                                <div>
                                    <div class="w-full rounded-full h-5 p-1 bg-dark-light overflow-hidden shadow-3xl dark:bg-dark-light/10 dark:shadow-none">
                                        <div :class="`bg-gradient-to-r from-[${item.colorf}] to-[${item.colors}] w-full h-full rounded-full relative before:absolute before:inset-y-0 ltr:before:right-0.5 rtl:before:left-0.5 before:bg-white before:w-2 before:h-2 before:rounded-full before:m-auto`" :style="`width: ${item.count}%`"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
            <?php
                $home3 = "SELECT * FROM home3 ORDER BY id DESC LIMIT 1";
                $recupHome3   = $bdd->executeQueryRequete($home3, 1);
                
                while( $item = $recupHome3->fetch() ) {
                    $email       = $item->email;
                    $firstname   = $item->firstname;
                    $lastname    = $item->lastname;
                    $date_in     = $item->date_in;
                    $tel_mobile  = $item->tel_mobile;
                    $tel_fixe    = $item->tel_fixe;
                    $dateofbirth = $item->dateofbirth;
                    $adresse_1   = $item->adresse_1;
                    $pays        = $item->pays;
                    $cp          = $item->cp;
                    $ville       = $item->ville;
                    $last_date_r = $item->last_date_r;
                    $last_date_o = $item->last_date_o;
                    $last_date_c = $item->last_date_c;
                }
		    ?>
            <div class="panel h-full">
                <div class="flex items-center justify-between dark:text-white-light mb-5">
                    <h5 class="font-semibold text-lg">Data analystic</h5>
                    <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                        <a href="javascript:;" @click="toggle">
                            <svg class="w-5 h-5 text-black/70 dark:text-white/70 hover:!text-primary" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                            </svg>
                        </a>
                        <ul x-cloak x-show="open" x-transition x-transition.duration.300ms class="ltr:right-0 rtl:left-0">
                            <li><a href="javascript:;" @click="toggle">View Report</a></li>
                            <li><a href="javascript:;" @click="toggle">Edit Report</a></li>
                            <li><a href="javascript:;" @click="toggle">Mark as Done</a></li>
                        </ul>
                    </div>
                </div>
                <div>
                    <div class="space-y-6">
                        <div class="flex">
                            <span class="shrink-0 grid place-content-center text-base w-9 h-9 rounded-md bg-success-light dark:bg-success text-success dark:text-success-light">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 1 0-2.636 6.364M16.5 12V8.25" />
                            </svg>

                            </span>
                            <div class="px-3 flex-1">
                                <div>Email</div>
                                <div class="text-xs text-white-dark dark:text-gray-500"></div>
                            </div>
                            <span class="text-base px-1 ltr:ml-auto rtl:mr-auto whitespace-pre"><?php echo "<b>".number_format($email, 0, "", " ")."</b> <span class='text-xs badge bg-info-light text-white-dark dark:text-gray-500 ltr:ml-auto rtl:mr-auto whitespace-pre' > ".round($email*100/$fullbase, 2)."%</span>"; ?></span>
                        </div>
                        <div class="flex">
                            <span class="shrink-0 grid place-content-center w-9 h-9 rounded-md bg-warning-light dark:bg-warning text-warning dark:text-warning-light">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                            </svg>

                            </span>
                            <div class="px-3 flex-1">
                                <div>Téléphone mobile</div>
                                <div class="text-xs text-white-dark dark:text-gray-500"></div>
                            </div>
                            <span class="text-danger text-base px-1 ltr:ml-auto rtl:mr-auto whitespace-pre"><?php echo "<b>".number_format($tel_mobile, 0, "", " ")."</b> <span class='text-xs badge bg-info-light text-white-dark dark:text-gray-500 ltr:ml-auto rtl:mr-auto whitespace-pre' > ".round($tel_mobile*100/$fullbase, 2)."%</span>"; ?></span></span>
                        </div>
                        <div class="flex">
                            <span class="shrink-0 grid place-content-center w-9 h-9 rounded-md bg-danger-light dark:bg-danger text-danger dark:text-danger-light">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                            </svg>

                            </span>
                            <div class="px-3 flex-1">
                                <div>Téléphone fixe</div>
                                <div class="text-xs text-white-dark dark:text-gray-500"></div>
                            </div>
                            <span class="text-success text-base px-1 ltr:ml-auto rtl:mr-auto whitespace-pre"><?php echo "<b>".number_format($tel_fixe, 0, "", " ")."</b> <span class='text-xs badge bg-info-light text-white-dark dark:text-gray-500 ltr:ml-auto rtl:mr-auto whitespace-pre' > ".round($tel_fixe*100/$fullbase, 2)."%</span>"; ?></span></span>
                        </div>
                        <div class="flex">
                            <span class="shrink-0 grid place-content-center w-9 h-9 rounded-md bg-primary-light dark:bg-primary text-primary dark:text-primary-light">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            </span>
                            <div class="px-3 flex-1">
                                <div>Adresse</div>
                                <div class="text-xs text-white-dark dark:text-gray-500"></div>
                            </div>
                            <span class="text-danger text-base px-1 ltr:ml-auto rtl:mr-auto whitespace-pre"><?php echo "<b>".number_format($adresse_1, 0, "", " ")."</b> <span class='text-xs badge bg-info-light text-white-dark dark:text-gray-500 ltr:ml-auto rtl:mr-auto whitespace-pre' > ".round($adresse_1*100/$fullbase, 2)."%</span>"; ?></span></span>
                        </div>
                        <div class="flex">
                            <span class="shrink-0 grid place-content-center w-9 h-9 rounded-md bg-secondary-light dark:bg-secondary text-secondary dark:text-secondary-light">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                            </span>
                            <div class="px-3 flex-1">
                                <div>Dernier mail reçu</div>
                                <div class="text-xs text-white-dark dark:text-gray-500"></div>
                            </div>
                            <span class="text-danger text-base px-1 ltr:ml-auto rtl:mr-auto whitespace-pre"><?php echo "<b>".number_format($last_date_r, 0, "", " ")."</b> <span class='text-xs badge bg-info-light text-white-dark dark:text-gray-500 ltr:ml-auto rtl:mr-auto whitespace-pre' > ".round($last_date_r*100/$fullbase, 2)."%</span>"; ?></span></span>
                        </div>
                        <div class="flex">
                            <span class="shrink-0 grid place-content-center text-base w-9 h-9 rounded-md bg-info-light dark:bg-info text-info dark:text-info-light">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 9v.906a2.25 2.25 0 0 1-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 0 0 1.183 1.981l6.478 3.488m8.839 2.51-4.66-2.51m0 0-1.023-.55a2.25 2.25 0 0 0-2.134 0l-1.022.55m0 0-4.661 2.51m16.5 1.615a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V8.844a2.25 2.25 0 0 1 1.183-1.981l7.5-4.039a2.25 2.25 0 0 1 2.134 0l7.5 4.039a2.25 2.25 0 0 1 1.183 1.98V19.5Z" />
                            </svg>
                            </span>
                            <div class="px-3 flex-1">
                                <div>Dernier mail ouvert</div>
                                <div class="text-xs text-white-dark dark:text-gray-500"></div>
                            </div>
                            <span class="text-success text-base px-1 ltr:ml-auto rtl:mr-auto whitespace-pre"><?php echo "<b>".number_format($last_date_o, 0, "", " ")."</b> <span class='text-xs badge bg-info-light text-white-dark dark:text-gray-500 ltr:ml-auto rtl:mr-auto whitespace-pre' > ".round($last_date_o*100/$fullbase, 2)."%</span>"; ?></span></span>
                        </div>
                        <div class="flex">
                            <span class="shrink-0 grid place-content-center w-9 h-9 rounded-md bg-primary-light dark:bg-primary text-primary dark:text-primary-light">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.926 9.70541C13.5474 9.33386 13.5474 8.74151 13.5474 7.55682V7.24712C13.5474 3.96249 13.5474 2.32018 12.6241 2.03721C11.7007 1.75425 10.711 3.09327 8.73167 5.77133L5.66953 9.91436C4.3848 11.6526 3.74244 12.5217 4.09639 13.205C4.10225 13.2164 4.10829 13.2276 4.1145 13.2387C4.48945 13.9117 5.59888 13.9117 7.81775 13.9117C9.05079 13.9117 9.6673 13.9117 10.054 14.2754" stroke="currentColor" stroke-width="1.5" />
                                    <path opacity="0.5" d="M13.9259 9.70557L13.9459 9.72481C14.3326 10.0885 14.9492 10.0885 16.1822 10.0885C18.4011 10.0885 19.5105 10.0885 19.8854 10.7615C19.8917 10.7726 19.8977 10.7838 19.9036 10.7951C20.2575 11.4785 19.6151 12.3476 18.3304 14.0858L15.2682 18.2288C13.2888 20.9069 12.2991 22.2459 11.3758 21.9629C10.4524 21.68 10.4524 20.0376 10.4525 16.753L10.4525 16.4434C10.4525 15.2587 10.4525 14.6663 10.074 14.2948L10.054 14.2755" stroke="currentColor" stroke-width="1.5" />
                                </svg>
                            </span>
                            <div class="px-3 flex-1">
                                <div>Dernier mail cliqué</div>
                                <div class="text-xs text-white-dark dark:text-gray-500"></div>
                            </div>
                            <span class="text-danger text-base px-1 ltr:ml-auto rtl:mr-auto whitespace-pre"><?php echo "<b>".number_format($last_date_c, 0, "", " ")."</b> <span class='text-xs badge bg-info-light text-white-dark dark:text-gray-500 ltr:ml-auto rtl:mr-auto whitespace-pre' > ".round($last_date_c*100/$fullbase, 2)."%</span>"; ?></span></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel h-full">
                <div class="flex items-center justify-between dark:text-white-light mb-5">
                    <h5 class="font-semibold text-lg">Ressources</h5>
                    <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                        <a href="javascript:;" @click="toggle">
                            <svg class="w-5 h-5 text-black/70 dark:text-white/70 hover:!text-primary" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="5" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                <circle opacity="0.5" cx="12" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                                <circle cx="19" cy="12" r="2" stroke="currentColor" stroke-width="1.5" />
                            </svg>
                        </a>
                        <ul x-cloak x-show="open" x-transition x-transition.duration.300ms class="ltr:right-0 rtl:left-0">
                            <li><a href="javascript:;" @click="toggle">View Report</a></li>
                            <li><a href="javascript:;" @click="toggle">Edit Report</a></li>
                            <li><a href="javascript:;" @click="toggle">Mark as Done</a></li>
                        </ul>
                    </div>
                </div>
                <div>
                    <div class="space-y-6">
                        <div class="flex">
                            <span class="shrink-0 grid place-content-center text-base w-9 h-9 rounded-md bg-success-light dark:bg-success text-success dark:text-success-light">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                            </svg>
                            H
                            </span>
                            <div class="px-3 flex-1">
                                <div>Total Hommes</div>
                                <div class="text-xs text-white-dark dark:text-gray-500"></div>
                            </div>
                            <span class="text-success text-base px-1 ltr:ml-auto rtl:mr-auto whitespace-pre"><?php echo "<b>".number_format($hommes, 0, "", " ")."</b> <span class='text-xs badge bg-info-light text-white-dark dark:text-gray-500 ltr:ml-auto rtl:mr-auto whitespace-pre' > ".round($hommes*100/$fullbase, 2)."%</span>"; ?></span></span>
                        </div>
                        <div class="flex">
                            <span class="shrink-0 grid place-content-center w-9 h-9 rounded-md bg-warning-light dark:bg-warning text-warning dark:text-warning-light">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                            </svg>
                            F
                            </span>
                            <div class="px-3 flex-1">
                                <div>Total Femmes</div>
                                <div class="text-xs text-white-dark dark:text-gray-500"></div>
                            </div>
                            <span class="text-danger text-base px-1 ltr:ml-auto rtl:mr-auto whitespace-pre"><?php echo "<b>".number_format($femmes, 0, "", " ")."</b> <span class='text-xs badge bg-info-light text-white-dark dark:text-gray-500 ltr:ml-auto rtl:mr-auto whitespace-pre' > ".round($femmes*100/$fullbase, 2)."%</span>"; ?></span></span>
                        </div>
                        <div class="flex">
                            <span class="shrink-0 grid place-content-center w-9 h-9 rounded-md bg-danger-light dark:bg-danger text-danger dark:text-danger-light">
                                P
                            </span>
                            <div class="px-3 flex-1">
                                <div>Prénom</div>
                                <div class="text-xs text-white-dark dark:text-gray-500"></div>
                            </div>
                            <span class="text-success text-base px-1 ltr:ml-auto rtl:mr-auto whitespace-pre"><?php echo "<b>".number_format($firstname, 0, "", " ")."</b> <span class='text-xs badge bg-info-light text-white-dark dark:text-gray-500 ltr:ml-auto rtl:mr-auto whitespace-pre' > ".round($firstname*100/$fullbase, 2)."%</span>"; ?></span></span>
                        </div>
                        <div class="flex">
                            <span class="shrink-0 grid place-content-center w-9 h-9 rounded-md bg-secondary-light dark:bg-secondary text-secondary dark:text-secondary-light">
                                N
                            </span>
                            <div class="px-3 flex-1">
                                <div>Nom</div>
                                <div class="text-xs text-white-dark dark:text-gray-500"></div>
                            </div>
                            <span class="text-danger text-base px-1 ltr:ml-auto rtl:mr-auto whitespace-pre"><?php echo "<b>".number_format($lastname, 0, "", " ")."</b> <span class='text-xs badge bg-info-light text-white-dark dark:text-gray-500 ltr:ml-auto rtl:mr-auto whitespace-pre' > ".round($lastname*100/$fullbase, 2)."%</span>"; ?></span></span>
                        </div>
                        <div class="flex">
                            <span class="shrink-0 grid place-content-center text-base w-9 h-9 rounded-md bg-info-light dark:bg-info text-info dark:text-info-light">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                </svg>
</span>
                            <div class="px-3 flex-1">
                                <div>Date de naissance</div>
                                <div class="text-xs text-white-dark dark:text-gray-500"></div>
                            </div>
                            <span class="text-success text-base px-1 ltr:ml-auto rtl:mr-auto whitespace-pre"><?php echo "<b>".number_format($date_in, 0, "", " ")."</b> <span class='text-xs badge bg-info-light text-white-dark dark:text-gray-500 ltr:ml-auto rtl:mr-auto whitespace-pre' > ".round($date_in*100/$fullbase, 2)."%</span>"; ?></span></span>
                        </div>
                        <div class="flex">
                            <span class="shrink-0 grid place-content-center w-9 h-9 rounded-md bg-primary-light dark:bg-primary text-primary dark:text-primary-light">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.926 9.70541C13.5474 9.33386 13.5474 8.74151 13.5474 7.55682V7.24712C13.5474 3.96249 13.5474 2.32018 12.6241 2.03721C11.7007 1.75425 10.711 3.09327 8.73167 5.77133L5.66953 9.91436C4.3848 11.6526 3.74244 12.5217 4.09639 13.205C4.10225 13.2164 4.10829 13.2276 4.1145 13.2387C4.48945 13.9117 5.59888 13.9117 7.81775 13.9117C9.05079 13.9117 9.6673 13.9117 10.054 14.2754" stroke="currentColor" stroke-width="1.5" />
                                    <path opacity="0.5" d="M13.9259 9.70557L13.9459 9.72481C14.3326 10.0885 14.9492 10.0885 16.1822 10.0885C18.4011 10.0885 19.5105 10.0885 19.8854 10.7615C19.8917 10.7726 19.8977 10.7838 19.9036 10.7951C20.2575 11.4785 19.6151 12.3476 18.3304 14.0858L15.2682 18.2288C13.2888 20.9069 12.2991 22.2459 11.3758 21.9629C10.4524 21.68 10.4524 20.0376 10.4525 16.753L10.4525 16.4434C10.4525 15.2587 10.4525 14.6663 10.074 14.2948L10.054 14.2755" stroke="currentColor" stroke-width="1.5" />
                                </svg>
                            </span>
                            <div class="px-3 flex-1">
                                <div>Parents</div>
                                <div class="text-xs text-white-dark dark:text-gray-500"></div>
                            </div>
                            <span class="text-danger text-base px-1 ltr:ml-auto rtl:mr-auto whitespace-pre">-$22.00</span>
                        </div>
                        <div class="flex">
                            <span class="shrink-0 grid place-content-center w-9 h-9 rounded-md bg-primary-light dark:bg-primary text-primary dark:text-primary-light">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 0 1-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 0 0-3.213-9.193 2.056 2.056 0 0 0-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 0 0-10.026 0 1.106 1.106 0 0 0-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                            </svg>
                            </span>
                            <div class="px-3 flex-1">
                                <div>Voiture</div>
                                <div class="text-xs text-white-dark dark:text-gray-500"></div>
                            </div>
                            <span class="text-danger text-base px-1 ltr:ml-auto rtl:mr-auto whitespace-pre">-$22.00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("alpine:init", () => {
        // finance
        Alpine.data("finance", () => ({
            init() {
                
            },
            languages: [
            {
                id: 1,
                key: 'France',
                value: 'fr',
                count:69,
                colorf: '#009ffd',
                colors: '#2a2a72',

            },
            {
                id: 2,
                key: 'Italie',
                value: 'it',
                count:17,
                colorf: '#a71d31',
                colors: '#3f0d12',
            },
            {
                id: 3,
                key: 'Portugal',
                value: 'pt',
                count:7,
                colorf: '#fe5f75',
                colors: '#fc9842',
            },
            {
                id: 5,
                key: 'Espagne',
                value: 'es',
                count:4,
                colorf: '#3cba92',
                colors: '#0ba360',
            },
            {
                id: 6,
                key: 'Angletaire',
                value: 'en',
                count:3,
                colorf: '#f09819',
                colors: '#ff5858',
            },
        ],
        }));
    });
</script>

<?php include 'footer-main.php'; ?>
