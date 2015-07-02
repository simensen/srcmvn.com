---
title: "Dutch PHP Conference (DPC) 2015 Review"
tags:
    - conferences
    - dpcon

---

I'm on the plane back from Dutch PHP Conference 2015 and I am still kind of shocked at how quickly the time went! I had a blast and am happy that I have the time to reflect on it right away!

I arrived Wednesday afternoon and got myself all checked in. The hotel was nice and the neighborhood was, well, I guess central Amsterdam-ey? A lot of shops, bars, and restaurants. I didn't have to go too far to find anything, really. The little streets and alleys and chill people milling about was kind of nice.

[Willem-Jan](https://twitter.com/willemjanz) let me know when he checked into the hotel so that we could get together to at least see each other in person once before we presented a tutorial together the next morning. We had met for the first time at [PHP Benelux](http://srcmvn.com/blog/2015/02/11/looking-back-on-phpbenelux-2015) and other than one or two video chats we hadn't talked in person.

It was nice catching up but I wanted to try and get to bed early so we went our separate ways. I did not end up getting to bed as early as I liked because I got involved in a few other discussions including discussing [Glide](http://glide.thephpleague.com/) supporting [PSR-7](http://www.php-fig.org/psr/psr-7/) in its next major release with [Jonathan Reinink](https://twitter.com/reinink). My ulterior motive here was that I thought it could make a nice last-minute addition to my PSR-7 talk two days later.

What is it with me and making more work for myself at the last minute? :)

---

I got up early and had a great breakfast at the hotel. I got to catch up with a few people before heading down to take the train with a group of other people to the venue.

Everything was setup and ready for us when we got there so we had a little extra time to have water, juice, and coffee.

DPC had actually selected one of my proposals for a tutorial on event sourcing and CQRS with broadway and asked if I'd be interested in doing it as a *full day* tutorial. We discussed how that might work out and landed on actually having two tutorials instead, [a morning session devoted to event sourcing and CQRS](https://beau.io/talks/2015/06/25/introduction-to-event-sourcing-and-cqrs-dpc-2015) and [an afternoon session that brought Broadway into the mix](https://beau.io/talks/2015/06/25/introduction-to-event-sourcing-and-cqrs-with-broadway-dpc-2015/). The idea was that it should work well for someone who only wanted to come one or the other but also still work well for people who wanted the whole day. We also discussed having Willem-Jan join the tutorial session to help out. 

Our plan worked out nicely. The majority of the people (16-18) came to both the morning and afternoon sessions. There were a handful of people in addition to that who came to just one or the other.

The morning session went pretty well. The big feedback I got was that I was going too fast with the live coding for people to catch up. I tried to slow things way down from that point on but I know that this is something I'll have to continue to work on.

It was a lot of help to have Willem-Jan there to assist. We didn't need a lot of that in the morning but there were a few times he stepped in to either help someone directly while I was presenting or to jump in with a question or idea on some of the core concepts behind event sourcing and CQRS.

As happened at phpDay, the live coding took a freestyle turn at the end where we tried to implement something that was naturally brought up by one of the people attending the session. We did not get to finish implementing it but seeing how to work through the process for something that wasn't already laid out was helpful.

The afternoon session started off with a bunch of slides showing Broadway's components. At a certain point I had a weird dry throat thing happen to me that I've never had happen before. My eyes started tearing up and I couldn't drink water fast enough. I think I drank 2-3 bottles of water in under five minutes while I tried to recover. Nobody dinged me on this so maybe it wasn't as bad as I thought but I felt like I was dying up there.

The slides for the second part only took about an hour so we jumped right back into the live coding. This is where the idea broke down a little bit. We revisited the same code from the morning session but rather than implementing it with our own homegrown ES/CQRS code, we implemented it with Broadway.

The first mistake was that this was maybe a little boring for people who were in the morning session. I saw it as reinforcing the information learned in the morning but I think if I give this tutorial in the future in two parts I'll make an effort to focus on *new* code for the afternoon session.

The second mistake was that as soon as I picked up on the first mistake I sped up the live coding so people didn't have to do too much of the same code again. The downside to this, of course, is that when we got to the new code, very few people had kept up with me. The fix to this was for me to commit the work in progress to that point and let everyone update their code locally. This worked out nicely but I'd like to avoid the underlying problems by using different code and by going slower.

We had a forced break right around the time I pushed the live code so we were able to come back and do fresh stuff that *nobody* had seen yet after the break. This meant more freestyle implementation fun. It also meant running actual code and seeing both event sourcing and CQRS running in the real world using just sqlite and the CLI.

One of the more interesting things that happened was that we ran some of the commands before their projectors were implemented. This meant that once the projector was implemented we saw invalid data. This led to some discussion on replaying event streams and rebuilding projections.

Willam-Jan had been working on some example code to try and rebuild a projection so we [put that code into place](https://github.com/dflydev/es-cqrs-broadway-workshop/commit/d7698f2bc5fff810a0b48be87af9627738dbe92d#diff-e1b626c852da33cd4a7004c8ae97a1f1), deleted the data for the projection from the read model, and rebuilt the projection manually by running the projector again for each aggregate root.

It highlighted some potential issues with Broadway's event store. Willem-Jan discussed the future of the event store implementation and some of the work people are already doing against it to address some of these concerns.

Collectively we all saw some issues with various parts of Broadway and Willem-Jan sent two pull requests against Broadway in real-time to address some of them. For example, one of the `::assert` calls gave no indication as to what was actually wrong. It took us 5-10 minutes just to track down why we were seeing an exception. The next time someone does the same thing, we'll be told right away what the problem is.

 * [#175: Removed @internal from public method](https://github.com/qandidate-labs/broadway/pull/175)
 * [#176: Better error message for NamedConstructorAggregateFactory assertion](https://github.com/qandidate-labs/broadway/pull/176)

This was my second live coding experience (unless you consider the interactive stuff I've done with Composer during my Composer tutorial "live coding") and it was a blast. I still have some things I need to work on (like slowing down) but overall I think it was pretty successful.

I was reminded of another thing I need to do better during this tutorial. I'll often ask questions that are hard for people to answer in the way that would be most useful for me. For example, "Is everyone caught up?" is not a very good way to find out who *isn't* caught up. I need to try to remember to ask something more like, "Does anyone need more time?" or "Is anyone still working on this?"

I found myself doing variations on that problem throughout the session and I realized I've done that in the past as well.

The reviews for both tutorial sessions have been positive so that made me happy. And I was super thankful for having my co-host Willem-Jan on deck for this. Thanks again!

I went back to the hotel and then got food with Willem-Jan to decompress. He helped me find some water and then ended up buying it for me. Apparently MasterCard and Maestro are two different things even though they have very similar logos.

It turns out a full day of giving tutorials can be exhausting!

---

Day 2 didn't go entirely as I had planned. At some point I realized I only had 45 minutes for my PSR-7 talk *including questions*. I did a trial run after some recent additions and it came out at just over an hour. Time to cut some stuff!

I mostly ended up cutting out narrative instead of slides. I ran another trial and it came out between 35-45 minutes. I figured that would be close enough and it was already getting pretty late in the day.

By the time I was packed ready to go I had missed most of the first conference day. I had fully intended to see talks on Friday as I wasn't going to be able to see many (any?) on Saturday so I was a little disappointed with myself that I pushed my talk tweaking so far out.

I got to the venue just in time to get ice cream which was a great treat! I also had a chance to catch up with some people that I hadn't been able to talk to yet. I went to my room shortly after to get all setup.

The talk came in at a decent time. It was well under the 45 minute mark so I had some time to answer several questions.

There was one question that I didn't have a good answer for, and that is "what are some good real-world use cases for middleware." The cookie encryption middleware wasn't seen as a middleware anyone would use. While I disagree (I think a lot of people are doing cookie encryption) I wasn't able to come up with any "real-world" middleware examples. I think I didn't quite follow the question and I feared that if the cookie encryption middleware isn't seen as a legitimate use case, any of the middleware I could think of off the top of my head wouldn't work, either.

On thinking now, the best example I've heard so far as a functioning middleware was one that [Larry Garfield](https://twitter.com/Crell) mentioned on our recent PHP Roundtable episode. That being a middleware that acted as a proxy between an API client and an underlying API where the proxy does some additional work like roles, authentication, and possibly filtering or doing transformations.

I had been a little nervous about my PSR-7 talk format going in. It worked very well at phpDay and it was well received, but that was also three days before it was accepted. I wondered, "will it be received as well after PSR-7 has been out for awhile?"

Based on the feedback I've received so far, it seems like it works just as well now as it did before. And based on the questions I received, there is still much more we can do to help raise awareness about PSR-7.

I'm giving this talk a few more times over the next six months so I see it evolving over time as awareness changes.

After my talk I setup shop to give away some [#ossart](https://oss.ninjagrl.com/) prints that I had been tweeting about. At some point I realized that the conference had already been over for the day for a bit and that almost everyone but me had left the venue. Oh no! This meant I was going to be late getting to the speaker dinner.

It wasn't so bad, though. I wasn't actually the only one left so I tagged along with a few other people and ended up getting to the venue just a little after the meeting time and long before about half of the speakers arrived.

We had an excellent meal and then went to meet the rest of the conference attendees as the social.

The social was very intimidating to me. I'd say a hundred or so PHP conference goers were milling around the front of the social location. Almost everyone was drinking and already chatting and I didn't recognize too many people on the edges. It is times like this that I start to wish I was better at the mingling and socializing thing. My flight instinct kicks in at times like this and I just want to go back to my room by myself where it is nice and quiet.

Fortunately Willem-Jan found me on the edge and we talked there for a bit. He wasn't planning on staying long, either. I mentioned wanting to meet [Cees-Jan Kiewiet](https://twitter.com/WyriHaximus) in person and he said that he was inside.

Inside? Nah. Will be too busy.

Actually, no. It turned out to be far quieter inside than I could have imagined and I actually sat down and had fun talking with people for a bit. So happy I went in!

I still wanted to get home relatively early, though, so I said goodbye. Cees-Jan wanted some [Sculpin](https://sculpin.io) sticker so we went to go find some. Then he helped me try to find some bottles of water. We finally found the supermarket but it was closed so we called it a night.

It was a nice but exhausting day.

---

On Saturday, the extent of my conferencing was limited to breakfast. I got to meet up with a few other people from the conference. It was a nice, long, relaxing breakfast.

As some of you know by now, I'm embarking on a new adventure with [Monii](http://monii.com/). I scheduled a meeting on Saturday with the Monii team since it was the first chance we had to get all but one of the team in the same place. At least for now this is a rare thing since I am the only member of the team not based out of the UK.

It wasn't clear how long our meeting would last and I had hoped I'd still be able to do some conferencing but the scheduling turned out to be too tight. With the venue a good 30 minutes away it turned out to not be possible to meet up with the conference again on Saturday.

---

This was my first DPC and I had a blast! I thought the [ibuildings](http://www.ibuildings.nl/) people did a wonderful job. Thanks for having me and I hope I can come back another time!
